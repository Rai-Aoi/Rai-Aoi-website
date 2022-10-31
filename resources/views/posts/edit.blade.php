@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <h1 class="header-gray">
            แก้ไขเรื่องร้องเรียน
        </h1>

        <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if($user->isAdmin() or $user->isStaff() or $user->isStudentAffair())
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
                       value="{{ old('title', $post->title) }}"
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
                       value="{{ old('tags', $tags) }}"
                       placeholder="เช่น ความสะอาด, น้ำท่วม, จราจร, ..." autocomplete="off">
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <label class="label-gray" for="types">หน่วยงาน</label>
                <select name="types" id="types" class="input-gray bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="{{ old('types', $types) }}"selected>{{ old('types', $types) }}</option>
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
            @if ($user->isStaff())
            <div class="relative z-0 mb-6 w-full group">
                <label class="label-gray" for="processes">สถานะงาน</label>
                <select name="processes" id="processes" class="input-gray bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="เสร็จสิ้น">เสร็จสิ้น</option>
                    <option value="{{ old('processes', $processes) }}"selected>{{ old('processes', $processes) }}</option>
                </select>
            </div>
            @elseif ($user->isStudentAffair())
            <div class="relative z-0 mb-6 w-full group">
                <label class="label-gray" for="processes">สถานะงาน</label>
                <select name="processes" id="processes" class="input-gray bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="รอรับเรื่อง">รอรับเรื่อง</option>
                    <option value="ดำเนินการ">ดำเนินการ</option>
                    <option value="ไม่อนุมัติ">ไม่อนุมัติ</option>
                    <option value="{{ old('processes', $processes) }}"selected>{{ old('processes', $processes) }}</option>
                </select>
            </div>
            @elseif ($user->isAdmin())
            <div class="relative z-0 mb-6 w-full group">
                <label class="label-gray" for="processes">สถานะงาน</label>
                <select name="processes" id="processes" class="input-gray bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="รอรับเรื่อง">รอรับเรื่อง</option>
                    <option value="ไม่อนุมัติ">ไม่อนุมัติ</option>
                    <option value="ดำเนินการ">ดำเนินการ</option>
                    <option value="เสร็จสิ้น">เสร็จสิ้น</option>
                    <option value="{{ old('processes', $processes) }}"selected>{{ old('processes', $processes) }}</option>
                </select>
            </div>
            @endif

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
                          required >{{ old('description', $post->description) }}</textarea>
            </div>

            <div class="relative z-0 my-6 w-full group bg-gray-200 rounded p-6">
                <label for="image" class="label-gray my-3">แก้ไขรูปภาพ</label>
                @if($post->image)    
                    <img src="/images/{{ ($post->image) }}" class="p-1 rounded mx-auto" height="300" width="300"/>
                @else
                    <img src="/images/no-image.jpg" class="p-1 rounded mx-auto" height="300" width="300"/>
                @endif
                <input class="label-gray mt-3" type="file" id="image" name="image"><br><br>
            </div>

            <div class="text-center">
                <button class="button-gray" type="submit">แก้ไข</button>
            </div>
            @else
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
                        value="{{ old('title', $post->title) }}"
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
                        value="{{ old('tags', $tags) }}"
                        placeholder="เช่น ความสะอาด, น้ำท่วม, จราจร, ..." autocomplete="off">
                </div>

                <div class="relative z-0 mb-6 w-full group">
                    <label class="label-gray" for="types">หน่วยงาน</label>
                    <select name="types" id="types" class="input-gray bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="{{ old('types', $types) }}"selected>{{ old('types', $types) }}</option>
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
                            required >{{ old('description', $post->description) }}</textarea>
                </div>

                <div class="relative z-0 my-6 w-full group bg-gray-200 rounded p-6">
                    <label for="image" class="label-gray my-3">แก้ไขรูปภาพ</label>
                    @if($post->image)    
                        <img src="/images/{{ ($post->image) }}" class="p-1 rounded mx-auto" height="300" width="300"/>
                    @else
                        <img src="/images/no-image.jpg" class="p-1 rounded mx-auto" height="300" width="300"/>
                    @endif
                    <input class="label-gray mt-3" type="file" id="image" name="image"><br><br>
                </div>

                <div class="text-center">
                    <button class="button-gray" type="submit">แก้ไข</button>
                </div>
            @endif
        </form>
    </section>

    @can('delete', $post)
    <section class="mx-8 mt-16">
        <div class="relative py-4">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-b border-red-300"></div>
            </div>
            <div class="relative flex justify-center">
                <span class="bg-white px-4 text-sm text-red-500">Danger Zone</span>
            </div>
        </div>

        <div>
            <h3 class="text-red-600 mb-4 text-2xl">
                Delete this Post
                <p class="text-gray-800 text-xl">
                    Once you delete a post, there is no going back. Please be certain.
                </p>
            </h3>

            <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="relative z-0 mb-6 w-full group">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        Post Title to Delete
                    </label>
                    <input type="text" name="title" id="title"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="" required>
                </div>
                <button class="app-button red" type="submit">DELETE</button>
            </form>
        </div>
    </section>
    @endcan
@endsection
