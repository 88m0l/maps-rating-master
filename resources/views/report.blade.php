<x-app-layout>
    <x-slot name="header">
        @include('includes/header')
    </x-slot>
    <div class="container p-5 mx-auto my-12 bg-white border md:px-12">
        @if(session('success'))
        <div class="alert alert-blue" style="background-color: #d9f0ff; color: #0056b3; padding: 10px; border-radius: 5px;">
            {{ session('success') }}
        </div>
        @endif
  <form action="{{ route('report.store') }}" method="post">
            @csrf
            <h4 class="mt-4 mb-4">بلغ عن موقع مكرر</h4>
            <hr/>

            <div class="mt-4">
                <input type='text' class="w-full px-4 py-2 mt-2 mb-6 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-400" value="{{ rawurldecode(url()->previous())  }}" id="place_url" name="place_url" readonly/>
            </div>

            <div class="">
                <input type='text' class="w-full px-4 py-2 mt-2 mb-6 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-400" placeholder="اسمك" name="name" required/>
            </div>

            <div class="">
                <input type='email' class="w-full px-4 py-2 mt-2 mb-6 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-400" placeholder="البريد الإلكتروني" name="email" required/>
            </div>

            <br>
            <input type="submit" class="px-4 py-2 mt-3 text-gray-200 bg-blue-600 rounded hover:bg-blue-500 focus:outline-none" value="إبلاغ">
        </form>
    </div>
</x-app-layout>
