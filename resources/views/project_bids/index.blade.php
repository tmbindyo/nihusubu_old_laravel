@extends('layouts.app', ['title' => __('Project task Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Project tasks') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('project_task.create') }}" class="btn btn-sm btn-primary">{{ __('Add project task') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{ __('Description') }}</th>
                                    <th scope="col">{{ __('Priority') }}</th>
                                    <th scope="col">{{ __('Total budget') }}</th>
                                    <th scope="col">{{ __('Used budget') }}</th>
                                    <th scope="col">{{ __('Remaining budget') }}</th>
                                    <th scope="col">{{ __('Start date') }}</th>
                                    <th scope="col">{{ __('End date') }}</th>
                                    <th scope="col">{{ __('Creation Date') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(is_array($projectTasks)){
                                    @foreach ($projectTasks as $project_task)
                                        <tr>
                                            <td>{{ $project_task->name }}</td>
                                            <td>{{ $project_task->description }}</td>
                                            <td>{{ $project_task->priority }}</td>
                                            <td>{{ $project_task->total_budget }}</td>
                                            <td>{{ $project_task->used_budget }}</td>
                                            <td>{{ $project_task->remaining_budget }}</td>
                                            <td>{{ $project_task->start_date }}</td>
                                            <td>{{ $project_task->end_date }}</td>
                                            <td>{{ $project_task->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        @if ($project_task->id != auth()->id())
                                                            <form action="{{ route('project_task.destroy', $project_task) }}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                
                                                                <a class="dropdown-item" href="{{ route('project_task.edit', $project_task) }}">{{ __('Edit') }}</a>
                                                                <button task="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this project task?") }}') ? this.parentElement.submit() : ''">
                                                                    {{ __('Delete') }}
                                                                </button>
                                                            </form>    
                                                        @else
                                                            <a class="dropdown-item" href="{{ route('project_task.edit', $project_task->id ) }}">{{ __('Edit') }}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        {{-- <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $project_tasks->links() }}
                        </nav> --}}
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection