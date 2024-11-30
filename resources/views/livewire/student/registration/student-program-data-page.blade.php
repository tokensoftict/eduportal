<div id="category-2-part" style="margin-bottom: 30px; height: 70vh">
    <div class="container">
        <div class="card">
            <form wire:submit.prevent="store">
                <div class="card-body">
                    <h5 class="card-title">Student Choice Of Programme</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Please complete the required information below</h6>

                    <div class="row">
                        <div class="col-sm-7 offset-sm-3 col-12 col-lg-7 mt-3">
                            <div class="form-group">
                                <label><b>Choice of Programme</b></label>
                                <select required wire:model="selectedCourse" class="form-control">
                                    <option>-Select Course-</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course['id'] }}">{{ $course['prefix'] }}. {{ $course['name'] }}</option>
                                    @endforeach
                                </select>
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
