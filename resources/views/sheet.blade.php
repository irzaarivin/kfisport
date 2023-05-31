@extends("layouts.main")

@section("content")

    <div class="sm:ml-56 mt-14 overflow-hidden">

        <div class="p-5 w-full flex justify-between text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            <h1 class="text-2xl">{{ $data->title }}</h1>

            <div class="z-50 flex items-center content-center">
                <button type="button" id="reload-sheet" class="text-dark-700 p-1 mr-3 focus:outline-none font-medium rounded-full text-sm text-center inline-flex items-center">
                    <ion-icon id="status-icon" class="text-3xl animate-spin" name="aperture"></ion-icon>
                </button>
                <button onclick="xtos('{{ $data->slug }}')" class="px-4 py-2 mr-3 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-800 dark:bg-green-600 dark:hover:bg-green-700" type="button">Export ke Excel</button>

                @if(auth()->user()->email == $data->owner)

                    <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearch" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700" type="button">Siapa yang dapat mengedit? <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <a href="?delete={{ $data->id }}" class="px-4 py-2 ml-3 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 dark:bg-red-600 dark:hover:bg-red-700" type="button" onclick="return confirm('Hapus SpreadSheet {{ $data->title }}?');">Hapus SpreadSheet</a>

                    <!-- Dropdown menu -->
                    <div id="dropdownSearch" class="z-50 h-auto hidden bg-white rounded-lg shadow box-border w-60 dark:bg-gray-700">
                        <form action="" method="post" id="formAccess" class="w-full pt-3">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <ul class="h-auto px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButton">

                                @foreach($users as $val)

                                    @if(in_array($val->email, $access))

                                        <li>
                                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">

                                                <input type="checkbox" id="{{ $val->email }}#{{ $val->name }}" value="{{ $val->email }}" name="access[]" class="cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-full border-0 outline-0 dark:bg-gray-600 dark:border-gray-500" checked>

                                                <label for="{{ $val->email }}#{{ $val->name }}" class="cursor-pointer w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                {{ $val->name }}
                                                </label>

                                            </div>
                                        </li>

                                    @elseif($val->email == auth()->user()->email)

                                    

                                    @else

                                        <li>
                                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">

                                                <input type="checkbox" id="{{ $val->email }}#{{ $val->name }}" value="{{ $val->email }}" name="access[]" class="cursor-pointer w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-full border-0 outline-0 dark:bg-gray-600 dark:border-gray-500">

                                                <label for="{{ $val->email }}#{{ $val->name }}" class="cursor-pointer w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                {{ $val->name }}
                                                </label>

                                            </div>
                                        </li>

                                    @endif

                                @endforeach
                           
                            </ul>

                            <button type="submit" class="focus:outline-none w-full text-white bg-green-700 hover:bg-green-800 font-medium text-sm py-2.5 rounded-b-lg dark:bg-green-600 dark:hover:bg-green-700">Simpan</button>

                        </form>
                    </div>

                @endif

            </div>


        </div>

        <div class="w-full h-full" id="spreadsheet"></div>

    </div>
    
    <link rel="stylesheet" href="../css/xspreadsheet.css">
    <script src="../js/xspreadsheet.js"></script>
    <script src="../js/xlsx.full.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script>
        const s = x_spreadsheet('#spreadsheet', {
            mode: 'edit', // edit | read
            showToolbar: true,
            showGrid: true,
            showContextmenu: true,
            row: {
                len: 100,
                height: 25,
            },
            col: {
                len: 26,
                width: 100,
                indexWidth: 60,
                minWidth: 60,
            },
            style: {
                bgcolor: '#ffffff',
                align: 'left',
                valign: 'middle',
                textwrap: false,
                strike: false,
                underline: false,
                color: '#0a0a0a',
                font: {
                    name: 'Arial',
                    size: 10,
                    bold: false,
                    italic: false,
                },
            },
        }).change((cdata) => {
            // Ambil data dari X-Spreadsheet
            var datas = s.getData();

            // Konversi data menjadi format JSON
            var jsonData = JSON.stringify(datas);

            console.log(jsonData);

            $.post('{{ env("APP_URL") }}api/save-spreadsheet', { data: jsonData, id: {{ $data->id }} })
            .done(function(response) {
                console.log(response); // Menampilkan respons dari skrip PHP
            })
            .fail(function(xhr, status, error) {
                console.log('Kesalahan:', error); // Menampilkan pesan kesalahan
            });
        });

        // Ambil data
        $('#status-icon').attr('name', 'aperture').addClass('animate-spin');

        $.post('{{ env("APP_URL") }}api/get-spreadsheet', { url: "{{ $data->slug }}" })
        .done(function(response) {
            console.log(response);
            var data = JSON.parse(response);
            s.loadData(data);
            $('#status-icon').removeClass('animate-spin').addClass('text-green-400').attr('name', 'checkmark-outline');
            setTimeout(function() {
                $('#status-icon').removeClass('text-green-400').attr('name', 'reload-outline');
            }, 1500);
        })
        .fail(function(xhr, status, error) {
            console.log('Kesalahan:', error, status, xhr);
            $('#status-icon').removeClass('animate-spin').addClass('text-red-400').attr('name', 'close-outline');
            setTimeout(function() {
                $('#status-icon').removeClass('text-red-400').attr('name', 'reload-outline');
            }, 1500);
        });

        document.getElementById("reload-sheet").addEventListener('click',()=>{
            // $('#status-icon').removeClass('bg-blue-500 hover:bg-blue-700').addClass('bg-green-500').text('✓ Loaded');
            $('#status-icon').attr('name', 'aperture').addClass('animate-spin');                
            // Ambil data
            $.post('{{ env("APP_URL") }}api/get-spreadsheet', { url: "{{ $data->slug }}" })
            .done(function(response) {
                console.log(response);
                var data = JSON.parse(response);
                s.loadData(data);
                $('#status-icon').removeClass('animate-spin').addClass('text-green-400').attr('name', 'checkmark-outline');
                setTimeout(function() {
                    $('#status-icon').removeClass('text-green-400').attr('name', 'reload-outline');
                }, 1500);
            })
            .fail(function(xhr, status, error) {
                $('#status-icon').removeClass('animate-spin').addClass('text-red-400').attr('name', 'close-outline');
                setTimeout(function() {
                    $('#status-icon').removeClass('text-red-400').attr('name', 'reload-outline');
                }, 1500);
            });
        });
    </script>
    <script>
        function downloadExcel(filename, workbook) {
            var excelData = XLSX.write(workbook, { bookType: 'xlsx', type: 'array' });

            var blob = new Blob([excelData], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });

            if (navigator.msSaveBlob) {
                // Untuk Internet Explorer atau Microsoft Edge
                navigator.msSaveBlob(blob, filename + '.xlsx');
            } else {
                // Untuk browser modern lainnya
                var link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = filename + '.xlsx';

                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }

        function xtos(filename) {
            let sdata = s.getData();
            console.log(sdata);
            var out = XLSX.utils.book_new();
            sdata.forEach(function (xws) {
                var ws = {};
                var rowobj = xws.rows;
                var minCoord = { r: 0, c: 0 }, maxCoord = { r: 0, c: 0 };
                for (var ri = 0; ri < rowobj.len; ++ri) {
                var row = rowobj[ri];
                if (!row) continue;

                Object.keys(row.cells).forEach(function (k) {
                    var idx = +k;
                    if (isNaN(idx)) return;

                    var lastRef = XLSX.utils.encode_cell({ r: ri, c: idx });
                    if (ri > maxCoord.r) maxCoord.r = ri;
                    if (idx > maxCoord.c) maxCoord.c = idx;

                    var cellText = row.cells[k].text, type = "s";
                    if (!cellText) {
                    cellText = "";
                    type = "z";
                    } else if (!isNaN(Number(cellText))) {
                    cellText = Number(cellText);
                    type = "n";
                    } else if (cellText.toLowerCase() === "true" || cellText.toLowerCase() === "false") {
                    cellText = Boolean(cellText);
                    type = "b";
                    }

                    ws[lastRef] = { v: cellText, t: type };

                    if (type == "s" && cellText[0] == "=") {
                    ws[lastRef].f = cellText.slice(1);
                    }

                    if (row.cells[k].merge != null) {
                    if (ws["!merges"] == null) ws["!merges"] = [];

                    ws["!merges"].push({
                        s: { r: ri, c: idx },
                        e: {
                        r: ri + row.cells[k].merge[0],
                        c: idx + row.cells[k].merge[1]
                        }
                    });
                    }
                });
                }
                ws["!ref"] = minCoord ? XLSX.utils.encode_range({
                s: minCoord,
                e: maxCoord
                }) : "A1";

                XLSX.utils.book_append_sheet(out, ws, xws.name);
            });

            downloadExcel(filename, out); // Panggil fungsi downloadExcel dengan nama file yang diinginkan dan objek workbook

        }
    </script>

@endsection