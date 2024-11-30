<div id="category-2-part" style="margin-bottom: 30px; height: auto; min-height: 70vh">
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
                                        <th>Action</th>
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
                                                        @if(is_array($file))
                                                            <option value="{{ $key }}&&&&{{ $file[1] }}">{{ $file[1] }}</option>
                                                        @else
                                                            <option value="{{ $key }}&&&&{{ $file }}">{{ $file }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                @if(isset($this->userdocumentUploaded[$keys]['filename']))
                                                    @php
                                                        $filename = $this->userdocumentUploaded[$keys]['filename'];
                                                        $filename = explode("&&&&", $filename);
                                                    @endphp
                                                    <button type="button" href="#" wire:click="deleteFile('{{ $filename[0] }}',{{ $keys }})" wire:loading.attr="disabled" class="btn btn-danger">
                                                        <span wire:loading wire:target="deleteFile('{{ $filename[0] }}', {{ $keys }})" class="fa fa-spin fa-spinner" role="status"></span>
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                @endif
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
                            <button type="submit"  class="btn btn-success btn-lg" wire:loading.attr="disabled">
                                <span wire:loading wire:target="store" class="fa fa-spin fa-spinner" role="status"></span>
                                Save Changes and Continue
                            </button>
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
