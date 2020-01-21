@extends('front.navebar')
@section('content')
    <section class="add-new-section">
        <div class="container">
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    <h1 class="text-center form-title">اضف عرض جديد</h1>
                    <form action="{{url('addoffer')}}" method="post" enctype="multipart/form-data">
                        <div class="img-input">
                            @csrf
                            <div class="img-input">
                                <label  for="customFileLang">صورة العرض</label>
                                <input type="file" class="bg-transparent" id="customFileLang" name="image" >
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="اسم العرض" id="offer-name" name="name">
                            <textarea name="content" id="offer-short-description" placeholder="وصف مختصر"></textarea>
                            <input type="text" placeholder="سعر العرض" id="offer-price" name="price">
                        </div>
                        <div class="input-group d-flex date">
                            <div>
                                <input type="date" class="from" placeholder="من" name="start_date"/>
                            </div>
                            <div>
                                <input type="date" class="to" placeholder="الى" name="end_date"/>
                            </div>
                        </div>
                        <button  type="submit" class="add-new-link">اضافة</button>
                    </form>

                </div>
            </div>
        </div>
    </section>
    @push('script')
    <script>
        $('.from').datepicker({
            uiLibrary: 'bootstrap4'
        });

        $('.to').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
    @endpush

    @endsection