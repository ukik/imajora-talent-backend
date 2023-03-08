@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Gallery</h4>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/talent/' . Auth::user()->slug) }}">Talent</a></li>
                <li class="breadcrumb-item active">Show all</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-4">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle dropdown-album" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Semua
                    </button>
                    <div class="dropdown-menu select-album">
                        <div class="dropdown-item" onclick="updateFilterAlbum(this)">Semua</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pb-4">
            @foreach ($photos as $photo)
            <div class="col-md-4 my-2 gallery-item" data-album="{{ $photo->albums->name }}">
                @if ($photo->image == 'null')
                <img class="img-fluid" width="400px" src="{{ asset('/dummy/gallery-dummy.png') }}" alt="preview">
                @else
                <img class="img-fluid" width="400px" src="{{ asset('uploads/gallery/photos_user_' . $photo->users->id . '/' . $photo->image) }}" alt="preview">
                @endif
                <form id="form-delete-gallery-{{ $photo->id }}" action="{{ route('photo.destroy', $photo->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                </form>
                <div class="media position-relative my-4">
                    @if ($photo->users->avatar)
                    <img class="mr-3 rounded-circle" width="50px" height="50px" src="{{ asset('/uploads/avatars/' . $photo->users->avatar) }}" alt="preview">
                    @else
                    <img src="{{ asset('/user/anonim.jpg') }}" class="mr-3 rounded-circle" width="50px" height="50px" alt="...">
                    @endif

                    <div class="media-body">
                        <h5 class="mt-0">{{ $photo->users->name }}</h5>
                        <small class="text-muted">{{ $photo->created_at->format('d, M Y') }}</small>
                        <p>{{ $photo->description }}</p>
                    </div>
                    <div class="form-group float-right">
                        <button type="button" class="btn btn-link text-danger" onclick="deleteGallery({{ $photo->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-mg-12">
                <div class="my-4">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination gallery-pagination"></ul>
                    </nav>
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
{{-- button deleted sweet alert --}}
<script>
    /** menyimpan semua element gallery */
    const galleries = document.querySelectorAll('.gallery-item');

    /**
     * variabel 'galleries' tadi itu tipe datanya bukan native array tapi NodeList,
     * jadi perlu di arraykan dulu agar bisa mengakses method 'filter' dan 'map' punya native array.
     * 
     * kode dibawah ini sama seperti
     * const arrayGalleries = [galleries[0], galleries[1], galleries[2], galleries[3], ...dan seterusnya];
     */
    const arrayGalleries = [...galleries];

    $(document).ready(function() {
        /** map, method yang menghasilkan array baru dengan item yang sesuai dengan nilai return */
        const albumSetiapElemen = arrayGalleries.map(function(gallery) {
            return gallery.dataset.album;
        });

        /** sintaksnya belibet tapi intinya yaitu menghapus duplikat nama albumnya, kemudian urutkan */
        const albums = [...new Set(albumSetiapElemen)].sort();

        /** menambah menu pilihan album di dropdown nya */
        const tombolDropdown = $('.select-album');
        for (const album of albums) {
            const option = $('<div class="dropdown-item" onclick="updateFilterAlbum(this)">' + album + '</div>');
            tombolDropdown.append(option);
        }

        /** langsung gaskeun saja, halaman kita tambahkan pagination */
        renderPaginations(arrayGalleries);
    });

    /** fungsi ini dipanggil ketika klik pilihan dropdown */
    function updateFilterAlbum(option) {
        /** simpan nama album yang di select */
        const albumName = option.textContent;

        /** method 'filter', biar hanya element galleri yang albumnya sesuai */
        const filteredGalleries = arrayGalleries.filter(function(gallery) {
            /** hmm... apakah element ini punya atribut 'data-album' yang sesuai */
            return gallery.dataset.album === albumName;
        });

        /** mengganti text dropdown nya, agar sesuai dengan kodratnya */
        document.querySelector('.dropdown-album').textContent = albumName;

        /** 
         * kalau yang dipilih valuenya adalah 'Semua',
         * tampilkan semua
         * 
         * kalau tidak, tampilkan hasil yang difilter tadi
         */
        const displayedAlbum = albumName === 'Semua' ? arrayGalleries : filteredGalleries;

        /** gaskeun tampilkan yang difilter, sekalian buatkan paginationnya */
        renderPaginations(displayedAlbum);
    }

    /** Menampilkan segala jenis items yang ada didalamnya */
    function renderPaginations(items) {
        /** Sembunyikan semua element galeri dengan menambahkan class 'd-none' */
        for (const gallery of arrayGalleries) {
            gallery.classList.add('d-none');
        }

        /** ini adalah element yang menampung tombol pagination nanti */
        const paginationElement = $('ul.gallery-pagination');

        /** kosongkan/hapuskan semua tombol pagination yang sedang ada */
        paginationElement.empty();

        const batasFilter = 9;
        const jumlahTombolPagination = Math.ceil(items.length / batasFilter);
        const tombolSebelumnya = $('<li class="page-item"><a class="page-link">Prev</a></li>');
        const tombolSelanjutnya = $('<li class="page-item"><a class="page-link">Next</a></li>');

        /** kosong dulu saat ini, nanti ditambah satu2 di for loop */
        const arrayTombolPagination = [];
        let halamanSaatIni = 1;

        for (let i = 0; i < jumlahTombolPagination; i++) {
            /**
             * membuat tombol pagination yang ada nomornya.
             * i + 1 karena arraynya dimulai dari 0, sedangkan yang mau ditampilkan berupa
             * 
             * prev 1 2 3 4 5 ...dst next
             */
            const tombolPagination = $('<li class="page-item"><a class="page-link">' + (i + 1) + '</a></li>');

            /** isi array dengan tombol yang baru dibuat */
            arrayTombolPagination.push(tombolPagination);
        }

        /** method yang dipakai untuk pindah halaman. APA? ada function dalam function??? */
        function setActive(halamanTerpilih) {
            /** validasi nomor halaman yang dipilih, tidak boleh minus atau kelewat batas. */
            if (halamanTerpilih <= 0 || halamanTerpilih > jumlahTombolPagination) {
                return;
            }

            /**
             * poin penting disini, kenapa bisa labil pakai method buat edit class nya
             * 
             * 'addClass' dan 'removeClass' adalah method yang dipakai kalau elemen yang
             * dibuat atau diselect adalah dari sintaks jQuery (yang pakai '$' lah pokoknya), sedangkan
             * 
             * 'classList.add' dan 'classList.remove' itu method yang dipakai kalau elemennya
             * dicolong dengan native javascript (ex. document.querySelector)
             */

            /** kenapa - 1 ?, karna index array dimulai dari 0 */
            const indexHalamanSaatIni = halamanSaatIni - 1;
            const indexHalamanTerpilih = halamanTerpilih - 1;

            /** pindahkan tombol yang aktif ke tombol yang terpilih */
            arrayTombolPagination[indexHalamanSaatIni]?.removeClass('active');
            arrayTombolPagination[indexHalamanTerpilih]?.addClass('active');

            /** ini aku lupa logikanya kok dikali ya? intinya seperti itulah */
            const indexAwalGaleriSaatIni = indexHalamanSaatIni * batasFilter;
            const indexAwalGaleriBaru = indexHalamanTerpilih * batasFilter;

            /** sembunyikan elemen yang saat ini aktif */
            for (let i = 0; i < batasFilter; i++) {
                items[indexAwalGaleriSaatIni + i]?.classList?.add('d-none');
            }

            /** tampilkan elemen berdasarkan index yang dipilih */
            for (let i = 0; i < batasFilter; i++) {
                items[indexAwalGaleriBaru + i]?.classList?.remove('d-none');
            }

            halamanSaatIni = halamanTerpilih;
        }

        /** hanya tampilkan tombol kalau jumlah tombolnya lebih dari satu */
        if (jumlahTombolPagination > 1) {
            /**
             * taroh semua element yang dibuat tadi ke element pagination nya
             * 
             * Harus berurutan ini biar bisa jadi
             * 
             * prev 1 2 3 4 5 ...dst next
             */
            paginationElement.append(tombolSebelumnya);
            for (let i = 0; i < arrayTombolPagination.length; i++) {
                paginationElement.append(arrayTombolPagination[i]);
            }
            paginationElement.append(tombolSelanjutnya);

            /** taroh event onclick di tiap2 tombol, biar ada efeknya ketika dipencet */
            tombolSebelumnya.click(function() {
                setActive(halamanSaatIni - 1);
            });
            tombolSelanjutnya.click(function() {
                setActive(halamanSaatIni + 1);
            });
            for (let i = 0; i < arrayTombolPagination.length; i++) {
                arrayTombolPagination[i].click(function() {
                    setActive(i + 1);
                });
            }
        }

        /** default halaman 1 */
        setActive(1);
    }

    function deleteGallery(id) {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            arrayTombolPagination: {
                confirm: {
                    text: 'Yes, delete it!',
                    className: 'btn btn-success'
                },
                cancel: {
                    visible: true,
                    className: 'btn btn-danger'
                }
            }
        }).then((Delete) => {
            if (Delete) {
                $('#form-delete-gallery-' + id).submit();
            } else {
                swal.close();
            }
        });
    }
</script>
@endpush
@endsection