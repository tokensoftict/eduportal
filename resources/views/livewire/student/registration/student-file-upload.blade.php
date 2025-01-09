<div id="category-2-part" style="margin-bottom: 30px; height: auto; min-height: 70vh">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Student Document Upload</h5>
                <h6 class="card-subtitle mb-2 text-muted">Please complete the required information below</h6>
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col-sm-4 col-12">
                            <h5>Upload Document Type</h5>
                            <form wire:submit.prevent="uploadFile()">
                                <div class="form-group form-group-sm mt-4">
                                    <label>Document Type</label>
                                    <select wire:model="type" class="form-control form-control-sm">
                                        <option>Select Document Type</option>
                                        @foreach($documentUploads as $key => $documentUpload)
                                            <option value="{{ $key }}">{{ $documentUpload }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="text-danger">{{ $errors->first('type') }}</span>
                                    @endif
                                </div>
                                <div class="form-group form-group-sm mt-2">
                                    <label>File</label>
                                    <input type="file" wire:model="file" class="form-control form-control-sm">
                                    @if ($errors->has('file'))
                                        <span class="text-danger">{{ $errors->first('file') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mt-4">
                                    <button class="btn btn-primary btn-sm" type="submit" wire:loading.attr="disabled">
                                        <span wire:loading wire:target="uploadedFiles" class="fa fa-spin fa-spinner" role="status"></span>
                                        Upload Document
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-1 col-12 mt-sm-0 mt-4"></div>
                        <div class="col-sm-7 col-12">
                            <h5>Document Uploaded</h5>
                            <br/>
                            <table class="table table-striped table-sm table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Document Type</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($myDocument as $key => $document)
                                        @php
                                            $originalFilename = explode("&&&&", $document['filename']);
                                            $documentType =  \App\Models\DocumentUpload::find($document['type']);
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $originalFilename[1] }}</td>
                                            <td>{{ $documentType->name }}</td>
                                            <td>
                                                <a href="{{ asset("storage/".$originalFilename[0]) }}" target="_blank" class="btn btn-sm btn-primary">View</a>
                                                &nbsp; &nbsp; &nbsp;
                                                <button wire:click="deleteFile('{{ $key }}')" class="btn btn-sm btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
                        <button type="button" wire:click="store"  class="btn btn-success btn-lg" wire:loading.attr="disabled">
                            <span wire:loading wire:target="store" class="fa fa-spin fa-spinner" role="status"></span>
                            Save Changes and Continue
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function triggerChange(name, obj, live) {
        @this.set(name, $(obj).val(), live);
    }
</script>
