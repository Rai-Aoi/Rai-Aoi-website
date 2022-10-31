@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <h1 class="header-gray">
            แจ้งเรื่องร้องเรียน
        </h1>

        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="relative z-0 mb-6 w-full group">
                <label for="title" class="label-gray">
                    หัวข้อเรื่อง
                </label>
                @if ($errors->has('title'))
                    <p class="text-red-600">
                        {{ $errors->first('title') }}
                    </p>
                @endif
                <input type="text" name="title" id="title"
                       class="input-gray @error('title') border-red-600 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ old('title') }}"
                       placeholder="" required>
            </div>


            <div class="relative z-0 mb-6 w-full group">
                <label class="label-gray" for="tags">ประเภทเรื่อง</label>
                @error('tags')
                    <p class="text-red-600">
                        {{ $message }}
                    </p>
                @enderror
                <input type="text" name="tags" id="tags"
                       class="input-gray bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="เช่น ความสะอาด, น้ำท่วม, จราจร, ..." autocomplete="off">
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <label class="label-gray" for="types">หน่วยงาน</label>
                <select name="types" id="types" 
                    class="input-gray bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="อื่นๆ"selected>โปรดเลือกหน่วยงานที่เกี่ยวข้อง</option>
                    <option value="คณะวิทยาศาสตร์">คณะวิทยาศาสตร์</option>
                    <option value="คณะมนุษยศาสตร์">คณะมนุษยศาสตร์</option>
                    <option value="คณะวิศวกรรมศาสตร์">คณะวิศวกรรมศาสตร์</option>
                    <option value="คณะบริหารธุรกิจ">คณะบริหารธุรกิจ</option>
                    <option value="คณะสังคมศาสตร์">คณะสังคมศาสตร์</option>
                    <option value="สำนักหอสมุด">สำนักหอสมุด</option>
                    <option value="สำนักบริหารการศึกษา">สำนักบริหารการศึกษา</option>
                    <option value="กองกิจการนิสิต">กองกิจการนิสิต</option>
                    <option value="องค์การนิสิต">องค์การนิสิต</option>
                    <option value="อื่นๆ">อื่นๆ</option>
                </select>
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <label for="description" class="label-gray">
                    รายละเอียด
                </label>
                @error('description')
                    <p class="text-red-600">
                        {{ $message }}
                    </p>
                @enderror
                <textarea rows="4" type="text" name="description" id="description"
                       class="input-gray"
                          required >{{ old('description') }}</textarea>
            </div>

            <div class="relative z-0 my-6 w-full group bg-gray-200 rounded p-6">
                <label for="image" class="label-gray my-3">เพิ่มรูปภาพ</label>
                <img id="previewImg" class="rounded mx-auto" accept="image/*">
                <input class="label-gray mt-3" type="file" id="image" name="image"><br><br>
            </div>

            <div class="text-center">
                <button class="button-gray" type="submit">แจ้งปัญหา</button>
            </div>

            <script>
                let imageFile = document.querySelector("#image");
                let previewImg = document.querySelector("#previewImg");
                imageFile.onchange = evt => {
                    const [file] = imageFile.files;
                    if(file){
                        previewImg.src = URL.createObjectURL(file);
                    }
                }
            </script>

        </form>
    </section>

@endsection
