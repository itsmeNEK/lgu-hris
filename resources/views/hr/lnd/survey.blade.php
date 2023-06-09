@extends('layouts.app')

@section('title', 'Self Assessment Questions')
@section('content')
    <div class="row justify-content-center">
        <h3>Self Assessment Questions</h3>
        <div class="col-12 col-md-10 mt-3">

            <h4 class="text-center">Adding of Self Assessment Questions</h4>

            @if ($edit_question)
                <form action="{{ route('hr.surveyQuestion.update', $edit_question->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                @else
                    <form action="{{ route('hr.surveyQuestion.store') }}" method="POST">
                        @csrf
            @endif
            <div class="row">
                <div class="col-12 mb-2 col-md-4">
                    <div class="form-floating mb-1">
                        <select name="type" id="type" class="form-control form-control-sm"
                            placeholder="Select type">
                            <option hidden>Select Type</option>
                            <option value="Core Competencies">Core Competencies</option>
                            <option value="Organizational Competencies">Organizational Competencies</option>
                            <option value="Technical Competencies">Technical Competencies</option>
                            <option value="Leadership Competencies">Leadership Competencies</option>
                        </select>
                        <label for="type">Type</label>
                    </div>
                    @error('type')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-12 mb-2 col-md">
                    <div class="form-floating mb-1">
                        <input type="text" class="form-control  @error('question') is-invalid @enderror" name="question"
                            id="question" placeholder="Question"
                            @if ($edit_question) value="{{ old('question', $edit_question->question) }}"
                        @else
                        value="{{ old('question') }}" @endif
                            value="{{ old('question') }}">
                        <label for="question">Question</label>
                    </div>
                    @error('question')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            @if ($edit_question)
                <div class="row">
                    <div class="col">
                        <button class="btn btn-outline-success w-100"><i class="fa-solid fa-check me-2"></i>Save </button>
                    </div>
                    <div class="col">

                        <a href="{{ route('hr.surveyQuestion.index') }}" class="btn btn-outline-success  w-100"><i
                                class="fa-solid fa-x me-2"></i>Cancel</a>
                    </div>
                </div>
            @else
                <button class="btn btn-outline-success w-100"><i class="fa-solid fa-plus me-2"></i>Add </button>
            @endif
            </form>

            <hr>
            <h2>All Questions</h2>
            <div class="row justify-content-end">
                <div class="col-12 col-md-4">
                    <form action="{{ route('hr.surveyQuestion.index') }}" method="get">
                        @csrf
                        <div class="input-group">
                                <select name="type" id="type" class="form-control form-control-sm"
                                placeholder="Select type">
                                <option value="">All Type</option>
                                <option value="Core Competencies">Core Competencies</option>
                                <option value="Organizational Competencies">Organizational Competencies</option>
                                <option value="Technical Competencies">Technical Competencies</option>
                                <option value="Leadership Competencies">Leadership Competencies</option>
                            </select>
                            <button class="btn btn-outline-warning fw-bold"><i
                                    class="fa-solid fa-magnifying-glass me-1"></i>Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive mt-5 " id="no-more-tables">
                <table class="table table-hover table-striped smnall table-sm text-center">
                    <thead>
                        <tr class="table-light">
                            <th class="numeric"></th>
                            <th class="numeric" width="20%">Type</th>
                            <th class="numeric" width="60%">Question</th>
                            <th class="numeric" width="10%"></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @forelse ($all_question as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td data-title="Type">
                                    {{ $item->type }}
                                </td>
                                <td data-title="Question">
                                    {{ $item->question }}
                                </td>
                                <td>
                                    <form action="{{ route('hr.surveyQuestion.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('hr.surveyQuestion.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm  text-white"><i class="fa-solid fa-pen"></i></a>

                                        <button class="btn btn-danger btn-sm text-white" type="submit">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <td colspan="5">No Applicants</td>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $all_question->links('pagination.custom') }}
                </div>
            </div>

        </div>
    </div>


@endsection
