@extends('cms.master')
@section('title', 'التصنيفات')

@section('tittle_1', ' اضافة التصنيف ')
@section('tittle_2', ' اضافة التصنيف ')


@section('styles')
    <style>
        .color {
            color: #fff;
            margin-inline: 15px;
            width: 35px;
        }
    </style>
@endsection


@section('content')

    <!-- Basic datatable -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">اضافة تصنيف</h5>
        </div>

        <div class="card-body">
            <!-- Right aligned buttons -->
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0"> اضافة تصنيف </h6>
                </div>
                <div class="card-body">
                    <form action="#">
                        <div class="mb-3">
                            <label class="form-label">اسم التصنيف</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="اسم التصنيف">
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="parent_id">الفئة الأب:</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="">بدون فئة أب</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="d-flex justify-content-end align-items-center">
                            <a href="{{ route('categoaries.index') }}" class="btn btn-light">الغاء</a>
                            <button type="button" onclick="performStore()" class="btn btn-primary ms-3"> اضافة <i
                                    class="ph-paper-plane-tilt ms-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /right aligned buttons -->

        </div>
    </div>
    <!-- /basic datatable -->

@endsection






@section('scripts')
    <script src="{{ asset('cms/assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('cms/assets/demo/pages/form_select2.js') }}"></script>
    <script>
        function performStore() {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('parent_id', document.getElementById('parent_id').value);
            storeAndUpdateSelect('/cms/admin/categoaries', formData)
            function storeAndUpdateSelect(url, data) {
                axios.post(url, data)
                    .then(function(response) {
                        showMessage(response.data);
                        clearForm();
                        clearAndHideErrors();
                        updateSelect(data);
                    })
                    .catch(function(error) {

                        if (error.response.data.errors !== undefined) {
                            showErrorMessages(error.response.data.errors);
                        } else {

                            showMessage(error.response.data);
                        }
                    });

            }
        }
        function updateSelect(data) {
            let selectElement = document.getElementById('parent_id');
            selectElement.innerHTML = '';

            let optionElement = document.createElement('option');
            optionElement.value = '';
            optionElement.textContent = 'بدون فئة أب';
            selectElement.appendChild(optionElement);

            data.forEach(function(category) {
                let optionElement = document.createElement('option');
                optionElement.value = category.id;
                optionElement.textContent = category.name;
                selectElement.appendChild(optionElement);
            });
        }
    </script>
@endsection
