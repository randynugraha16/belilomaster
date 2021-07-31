@extends('layouts.dashboard')

@section('title')
    Detail Produk
@endsection

@section('content')
<div id="page-content-wrapper">
  <!-- Section content -->
  <div
    data-aos="fade-up"
    class="section-content section-dashboard-home"
  >
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">{{ $product->name }}</h2>
        <p class="dashboard-subtitle">Ubah Detail Produk Kamu</p>
      </div>
      <div class="dashboard-content">
        <div class="row">
          <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
                </div>
            @endif
            <form id="someForm" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Nama Produk</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Stok</label>
                        <input type="number" class="form-control" value="{{ ($product->stock - $product->transaction->count()) }}" name="stock" required/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Harga Jual</label>
                        <input type="number" name="price" value="{{ $product->price }}" class="form-control"/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Harga Modal</label>
                        <input type="number" name="harga_modal" value="{{ $product->harga_modal }}" class="form-control" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Kategori</label>
                        <select name="categories_id" class="form-control">
                          <option value="{{ $product->categories_id }}">{{ $product->category->name }}</option>
                          @foreach ($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Berat (gram)</label>
                        <input type="number" class="form-control" name="weight" value="{{ $product->weight }}"  required/>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">Deskripsi Produk</label>
                        <textarea name="description" id="editor">{!! $product->description !!}</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 mt-4">
                      <button
                        class="btn btn-success btn-block"
                        type="submit"
                        onclick="updateProduct()"
                      >
                        Simpan Perubahan
                      </button>
                      <button
                        class="btn btn-danger btn-block"
                        type="submit"
                        onclick="deleteProduct()"
                      >
                        Hapus Produk
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="row">
                  @foreach ($product->galleries as $gallery)
                    <div class="col-md-4">
                        <div class="gallery-container">
                            <img
                            src="{{ Storage::url($gallery->photos ?? '') }}"
                            alt=""
                            class="w-100"
                            />
                            <a href="{{ route('dashboard-product-gallery-delete', $gallery->id) }}" class="delete-gallery">
                            <img src="/images/icon-delete.svg " alt="" />
                            </a>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-12">
                        <form action="{{ route('dashboard-product-gallery-upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" name="products_id" value="{{ $product->id }}">
                            <input
                                type="file"
                                name="photos"
                                id="file"
                                style="display: none"
                                onchange="form.submit()"
                            />
                            <button
                                type="button"
                                class="btn btn-secondary btn-block mt-3"
                                onclick="thisFileUpload()"
                            >
                                Tambah Foto
                            </button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace("editor");
</script>
<script>
  function thisFileUpload() {
    document.getElementById("file").click();
  }
</script>
<script>
  form=document.getElementById("someForm");
    function updateProduct() {
        form.action="{{ route('dashboard-product-update', $product->id) }}";
        form.submit();
    }
    function deleteProduct() {
        form.action="{{ route('dashboard-product-delete', $product->id) }}";
        form.submit();
    }
</script>
@endpush