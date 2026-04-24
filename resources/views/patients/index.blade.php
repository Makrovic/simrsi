<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIM RSI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('patients.create') }}" class="btn btn-md btn-success mb-3">ADD PATIENT</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">NAMA PASIEN</th>
                                    <th scope="col">JENIS KELAMIN</th>
                                    <th scope="col">TGL LAHIR</th>
                                    <th scope="col">ALAMAT</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($patients as $patient)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $patient->nama_pasien }}</td>
                                        <td>{{ $patient->jenis_kelamin }}</td>
                                        <td>{{ $patient->tgl_lahir_pasien->format('Y-m-d') }}</td>
                                        <td>{{ $patient->alamat_pasien }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                data-bs-target="#modalDetail{{ $patient->id }}"
                                                data-nama="{{ $patient->nama_pasien }}"
                                                data-tgllahir="{{ $patient->tgl_lahir_pasien }}">
                                                VIEW DETAIL
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal untuk setiap patient -->
                                    <div class="modal fade" id="modalDetail{{ $patient->id }}" tabindex="-1"
                                        aria-labelledby="modalLabel{{ $patient->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel{{ $patient->id }}">Detail
                                                        Pasien</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <strong>Nama Pasien:</strong>
                                                        <p>{{ $patient->nama_pasien }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <strong>Usia (Tahun):</strong>
                                                        <p id="usia{{ $patient->id }}">-</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        document.getElementById('modalDetail{{ $patient->id }}').addEventListener('show.bs.modal', function() {
                                            const birthDate = new Date('{{ $patient->tgl_lahir_pasien }}');
                                            const today = new Date();
                                            let umur = today.getFullYear() - birthDate.getFullYear();
                                            document.getElementById('usia{{ $patient->id }}').innerText = umur;
                                        });
                                    </script>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Patients belum ada.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $patients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        //message with sweetalert
        @if (session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>

</body>

</html>
