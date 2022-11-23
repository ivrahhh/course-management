@extends('layouts.admin')

@section('content')
<div class="overflow-x-auto relative shadow rounded-lg">
    <table class="text-sm w-full rounded-lg text-left">
        <thead>
            <tr class="bg-slate-900 text-white divide-x divide-gray-400">
                <th scope="col" class="px-6 py-3">Department ID</th>
                <th scope="col" class="px-6 py-3">Department</th>
                <th scope="col" class="px-6 py-3">Date Added</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
                <tr class="divide-x border">
                    <td class="px-6 py-3">{{ $department->id }}</td>
                    <td class="px-6 py-3">{{ $department->name }}</td>
                    <td class="px-6 py-3">{{ $department->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="p-4">
    {{ $departments->links('components.pagination') }}
</div>
@endsection