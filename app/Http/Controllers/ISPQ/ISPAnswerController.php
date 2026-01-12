<?php

namespace App\Http\Controllers\ISPQ;

use App\Http\Controllers\Controller;

use App\Models\ISPQ\ISPAnswer;
use App\Models\ISPQ\ISPChoice;
use App\Models\ISPQ\ISPQuestion;
use App\Services\ISPQ\QuestionChoiceService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ISPAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(QuestionChoiceService $questionChoiceService)
    {
        $isp_question = $questionChoiceService->get();
        $answers = ISPAnswer::where('school_id', Auth::guard('school')->user()->pk_school_id)->with(['choice.question'])->get();

        return view('SchoolSide.ISPQ.index', compact('isp_question', 'answers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $school_id = Auth::guard('school')->user()->pk_school_id;

        $question_list  = ISPQuestion::all();
        try {
            foreach ($question_list as $question) {
                if ($question->question_type == 'text') {
                    ISPAnswer::create([
                        'school_id' => $school_id,
                        'question_id' => $question->id,
                        'choice_id' => null,
                        'other_value' => null,
                        'text_value' => $request->answer[$question->id],
                        'numeric_value' => null,
                    ]);
                }
                if ($question->question_type == 'number') {
                    ISPAnswer::create([
                        'school_id' => $school_id,
                        'question_id' => $question->id,
                        'choice_id' => null,
                        'other_value' => null,
                        'text_value' => null,
                        'numeric_value' => (int)$request->answer[$question->id],
                    ]);
                }
                if ($question->question_type == 'multiple') {
                    foreach ($request->answer[$question->id] as $choice_id) {
                        if (ISPChoice::find($choice_id)->choice_text !== 'Others') {
                            ISPAnswer::create([
                                'school_id' => $school_id,
                                'choice_id' => $choice_id,
                                'question_id' => $question->id,
                                'other_value' => null,
                                'text_value' => null,
                                'numeric_value' => null,
                            ]);
                        }
                        if (isset($request->other[$question->id][$choice_id])) {
                            ISPAnswer::create([
                                'school_id' => $school_id,
                                'choice_id' => $choice_id,
                                'question_id' => $question->id,
                                'other_value' => $request->other[$question->id][$choice_id],
                                'text_value' => null,
                                'numeric_value' => null,
                            ]);
                        }
                    }
                    if (isset($request->other_value[$question->id])) {
                        ISPAnswer::create([
                            'school_id' => $school_id,
                            'choice_id' => null,
                            'question_id' => $question->id,
                            'other_value' => $request->other_value[$question->id],
                            'text_value' => null,
                            'numeric_value' => null,
                        ]);
                    }
                }
                if ($question->question_type == 'single') {
                    ISPAnswer::create([
                        'school_id' => $school_id,
                        'choice_id' => $request->answer[$question->id],
                        'question_id' => $question->id,
                        'other_value' => null,
                        'text_value' => null,
                        'numeric_value' => null,
                    ]);
                }
                if ($question->question_type == 'boolean') {
                    ISPAnswer::create([
                        'question_id' => $question->id,
                        'school_id' => $school_id,
                        'choice_id' => $request->answer[$question->id],
                        'other_value' => null,
                        'text_value' => null,
                        'numeric_value' => null,
                    ]);
                }
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while submitting your answers: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Your answers have been submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ISPAnswer $iSPAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ISPAnswer $iSPAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request->all());
        return redirect()->back()->with('success', 'This feature is under development.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ISPAnswer $iSPAnswer)
    {
        //
    }
}
