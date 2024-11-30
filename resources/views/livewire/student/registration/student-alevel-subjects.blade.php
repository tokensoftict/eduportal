<div id="category-2-part" style="margin-bottom: 30px; height: auto; min-height: 70vh">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Student A-Level Subject Page</h5>
                <h6 class="card-subtitle mb-2 text-muted">Please add three(3) A Level Subject</h6>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form action="" method="post" wire:submit.prevent="addSubject">
                                <div class="row">
                                    <div class="col-sm-7 col-12 col-lg-7">
                                        <div class="form-group">
                                            <label>Subjects</label>
                                            <select wire:model="selectedSubject"  class="form-control sittings">
                                                <option value="">-Select Subjects-</option>
                                                @foreach($subjects as $id =>$subject)
                                                    <option value="{{ $id }}">{{ $subject }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-12 col-lg-2">
                                        <br/>
                                        <button type="submit" class="btn btn-primary btn-sm mt-2" wire:loading.attr="disabled">
                                            <span wire:loading wire:target="addSubject" class="fa fa-spin fa-spinner" role="status"></span>
                                            Add Subject
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-7 col-12">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Subject</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($aLevelSubjects as $aLevelSubject)
                                    <tr>
                                        @php
                                            $sub = \App\Models\AlevelSubject::find($aLevelSubject);
                                        @endphp
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sub->name }}</td>
                                        <td>
                                            <button type="button" href="#" wire:click="removeSubject('{{ $sub->id }}')" wire:loading.attr="disabled" class="btn btn-danger">
                                                <span wire:loading wire:target="removeSubject('{{ $sub->id }}')" class="fa fa-spin fa-spinner" role="status"></span>
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6 text-left">
                            <button type="button" wire:click="back" class="btn btn-danger btn-lg" wire:loading.attr="disabled">
                                <span wire:loading wire:target="back" class="fa fa-spin fa-spinner" role="status"></span>
                                Back
                            </button>
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" {{ count($aLevelSubjects) < 3 ? "disabled" : "" }} wire:click="store" class="btn btn-success btn-lg" wire:loading.attr="disabled">
                                <span wire:loading wire:target="store" class="fa fa-spin fa-spinner" role="status"></span>
                                Save Changes and Continue
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @script
    <script>
        function triggerChange(name, obj, live) {
            @this.set(name, $(obj).val(), live);
        }
    </script>
@endscript
