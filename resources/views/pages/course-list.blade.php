@extends('layouts.admin')

@section('content')
<div class="overflow-x-auto relative shadow rounded-lg">
    <table class="text-sm w-full rounded-lg text-left">
        <thead>
            <tr class="bg-slate-900 text-white divide-x divide-gray-400">
                <th scope="col" class="px-6 py-3">Course ID</th>
                <th scope="col" class="px-6 py-3">Course</th>
                <th scope="col" class="px-6 py-3">Department</th>
                <th scope="col" class="px-6 py-3">Date Added</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr class="divide-x border">
                    <td class="px-6 py-3">{{ $course->id }}</td>
                    <td class="px-6 py-3">{{ $course->name }}</td>
                    <td class="px-6 py-3">{{ $course->department->name }}</td>
                    <td class="px-6 py-3">{{ $course->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="p-4">
    {{ $courses->links('components.pagination') }}
</div>
@endsection