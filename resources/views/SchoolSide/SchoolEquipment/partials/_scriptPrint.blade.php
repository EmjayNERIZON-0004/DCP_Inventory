   <script>
       function printEquipment(id) {
           const table = document.getElementById('equipment-print-' + id);
           if (!table) return;

           const win = window.open('', '', 'width=900,height=700');

           win.document.write(`
                    <html>
                    <head>
                        <title>Print Equipment</title>
                        <style>
                            body { font-family: Arial, sans-serif !important; padding: 20px; }
                            table { width: 100% !important; border-collapse: collapse !important; }
                            td, th { border: 1px solid #000 !important; padding: 6px !important; }
                            .bg-gray-300 { background: #d1d5db !important; }
                            .bg-gray-100 { background: #f3f4f6 !important; }
                            .font-bold { font-weight: bold !important; }
                            .text-center { text-align: center !important; }
                            * {
                                    -webkit-print-color-adjust: exact !important;
                                    print-color-adjust: exact !important;
                                }
                            @media print {

                                body {
                                    font-family: Arial, sans-serif;
                                    background: white;
                                }

                                table {
                                    width: 100%;
                                    border-collapse: collapse;
                                    page-break-inside: avoid;
                                }

                                td, th {
                                    border: 1px solid #000;
                                    padding: 6px;
                                    font-size: 12px;
                                }

                                /* Tailwind background fixes */
                                .bg-gray-300 {
                                    background-color: #d1d5db !important;
                                }

                                .bg-gray-100 {
                                    background-color: #f3f4f6 !important;
                                }

                                /* Hide buttons when printing */
                                button {
                                    display: none !important;
                                }
                            }

                        </style>
                    </head>
                    <body>
                        ${table.outerHTML}
                    </body>
                    </html>
                `);

           win.document.close();
           win.focus();
           win.print();
           win.close();
       }
   </script>
