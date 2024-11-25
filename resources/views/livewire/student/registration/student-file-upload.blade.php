<div id="category-2-part" style="margin-bottom: 30px; height: 70vh">
    <div class="container">
        <div class="card">
            <form wire:submit.prevent="store">
                <div class="card-body">
                    <h5 class="card-title">Student Document Upload</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Please complete the required information below</h6>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-12 col-lg-6">
                                <x-filepond::upload wire:model="file" max-files="5" multiple="true" />
                            </div>
                            <div class="col-sm-6 col-12 col-lg-6">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Document Type</th>
                                        <th class="text-center">Document Uploaded</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $loopDocumentUploads = $documentUploads;
                                    @endphp
                                    @foreach($documentUploads as $keys =>$documentUpload)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <select class="form-control" wire:model="userdocumentUploaded.{{ $keys }}.type" onchange="triggerChange('userdocumentUploaded.{{ $keys }}.type', this, false)">
                                                    <option>Select Document Type</option>
                                                    @foreach($loopDocumentUploads as $key => $documentUpload)
                                                        <option value="{{ $key }}">{{ $documentUpload }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" wire:model="userdocumentUploaded.{{ $keys }}.filename" onchange="triggerChange('userdocumentUploaded.{{ $keys }}.filename', this, false)">
                                                    <option>Select Uploaded Document</option>
                                                    @foreach($uploadedFiles as $key =>$file)
                                                        <option value="{{ $key }}">{{ $file }}</option>
                                                    @endforeach
                                                </select>
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
                            <button type="button" wire:click="back" class="btn btn-danger btn-lg">Back</button>
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" wire:click="store" class="btn btn-success btn-lg">Save Changes and Continue</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function triggerChange(name, obj, live) {
        @this.set(name, $(obj).val(), live);
    }
</script>
