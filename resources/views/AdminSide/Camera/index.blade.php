 @extends('layout.Admin-Side')
 <title> @yield('title', 'DCP Dashboard')</title>
 @section('content')
     <meta charset="UTF-8">
     <title>QR Code Scanner</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">

     {{-- Include the html5-qrcode library --}}
     <script src="https://unpkg.com/html5-qrcode"></script>

     {{-- Optional styling --}}
     <style>
         h2 {
             text-align: center;

         }

         #reader {
             width: 320px;
             margin: 20px auto;

             border-radius: 10px;
             background: #fff;
             padding: 10px;
         }

         #result-box {
             text-align: center;
             margin-top: 20px;
         }

         #scannedCode {
             font-size: 14px;
             font-weight: bold;
             color: #1a73e8;
             word-break: break-all;
         }

         #monitorBtn {
             margin-top: 15px;
             padding: 10px 20px;
             background-color: #1a73e8;
             border: none;
             border-radius: 5px;
             color: white;
             cursor: pointer;
         }

         #monitorBtn:disabled {
             background-color: #aaa;
             cursor: not-allowed;
         }

         #status {
             margin-top: 10px;
             font-weight: bold;
         }
     </style>
     <div class="  w-full flex justify-center">
         <div class="bg-white my-5  mx-auto max-w-lg   p-4 border border-gray-300 rounded-sm shadow-sm">


             <h2 class="text-2xl text-blue-600 font-bold"> Scan QR Code</h2>

             <div class="border border-gray-300 shadow-md" id="reader"></div>

             <div id="result-box">
                 <div>Scanned Code:</div>
                 <div id="scannedCode">—</div>
                 <button id="monitorBtn" disabled>Mark as Monitored</button>
                 <div class="text-lg font-medium text-gray-500" id="status">Waiting for scan...</div>
             </div>
         </div>
     </div>

     <script>
         const statusText = document.getElementById('status');
         const codeDisplay = document.getElementById('scannedCode');
         const monitorBtn = document.getElementById('monitorBtn');

         let scannedCode = "";

         // 1️⃣ When QR code is scanned
         function onScanSuccess(qrCodeMessage) {
             console.log("Scanned:", qrCodeMessage);
             statusText.innerText = "QR scanned successfully!";

             // Extract code from URL
             let parts = qrCodeMessage.split("/");
             scannedCode = parts.pop() || parts.pop(); // handles trailing slashes
             codeDisplay.innerText = scannedCode;

             // Enable the button
             monitorBtn.disabled = false;
         }

         function onScanError(errorMessage) {
             // ignore frequent errors
         }

         // 2️⃣ When "Mark as Monitored" button is clicked
         monitorBtn.addEventListener("click", () => {
             if (!scannedCode) {
                 statusText.innerText = "No QR code scanned yet.";
                 return;
             }

             statusText.innerText = "Updating record...";

             fetch("/Admin/update-record-status-of-item", {
                     method: "POST",
                     headers: {
                         "Content-Type": "application/json",
                         "X-CSRF-TOKEN": "{{ csrf_token() }}"
                     },
                     body: JSON.stringify({
                         code: scannedCode
                     })
                 })
                 .then(response => response.json())
                 .then(data => {
                     console.log("Server response:", data);
                     statusText.innerText = data.message;

                     if (data.message.includes("success")) {
                         monitorBtn.disabled = true;
                         codeDisplay.innerText = '';

                     }
                 })
                 .catch(err => {
                     console.error(err);
                     statusText.innerText = "Error: " + err.message;
                 });
         });

         // 3️⃣ Initialize the camera scanner
         const html5QrCode = new Html5Qrcode("reader");
         html5QrCode.start({
                 facingMode: "environment"
             }, {
                 fps: 10,
                 qrbox: 250
             },
             onScanSuccess,
             onScanError
         ).catch(err => {
             console.error("Unable to start camera:", err);
             statusText.innerText = "Camera access failed. Check permissions.";
         });
     </script>
 @endsection
