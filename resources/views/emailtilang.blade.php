<html>
<head>
<title>E-Tilang</title>
<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }


    .m-b-md {
        margin-bottom: 30px;
    }

    .buttonVer {
        padding : 10px 15px;
    }

</style>
</head>
<body>
    <h3>Halo kak {{ $ktp->nama }}</h3>

    <p>Dikarenakan Bpk/Ibu sudah melakukan pelanggaran sebanyak 3 kali dan sesuai dengan peraturan makan dengan berat hati kami telah menilang Bpk/Ibu.
    <p>Adapun daftar pelanggaran yang telah Bpk/Ibu <b>{{ $ktp->nama }}</b> Lakukan :</p>

    <h3 class="p-5">Daftar Pelanggaran</h3>
      <table class="table table-borderless table-striped table-hover">
            <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Perkara</th>
                        <th>Denda</th>
                        <th>Total Denda</th>
                        <th>Tanggal Pelanggaran</th>
                  </tr>
            </thead>
            <tbody>
                    @php 
                        $no = 1;
                    @endphp
                    @php 
                        $totalDenda = 0;
                        $itemCount = count($pel->PelanggaranItem);

                    @endphp

                    @foreach($pel->PelanggaranItem as $item)
                    @php 
                        $totalDenda += $item->denda;
                    @endphp
                    @endforeach
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $pel->nik }}</td>
                        <td> - </td>
                        <td> - </td>
                        <td>Rp. {{ number_format($totalDenda) }}</td>
                        <td>{{ $pel->created_at }}</td>
                    </tr>
                        @foreach($pel->PelanggaranItem as $item)
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{ $item->Pasal->perkara }}</td>
                        <td>Rp. {{ number_format($item->denda) }}</td>
                        <td> - </td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                        @endforeach
                    @php 
                        $no++;
                    @endphp
            </tbody>
      </table>


    <p>Demikian Bpk/Ibu <b>{{ $ktp->nama }}.</b>  yang dapat kami sampaikan. Selamat melanjutkan aktifitas, sukses dan bahagia selalu kakak <b>{{ $ktp->nama }}.</b></p>
    <br>

    <p><b>Salam Hangat,</b></p>
    <p><b>E-Tilang Univ. MH Thamrin</b></p>

</body>
</html>




