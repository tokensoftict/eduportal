@section('title')
    My Account
@endsection
<div id="category-2-part" style="margin-bottom: 30px;">
    <div class="container">
        <div class="card">
            <form wire:submit.prevent="store">
                <div class="card-body">
                    <h5 class="card-title">Student Bio Data Page</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Please complete the required information below</h6>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h6>Full name : <span class="text-info">{{ auth('student')->user()->name }}</span></h6>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Nationality</label>
                                    <select wire:model.live="data.country_id" onchange="triggerChange('data.country_id', this, true)" class="form-control">
                                        @foreach($nationalites as $key => $nationality)
                                            <option {{ config('app.DEFAULT_COUNTRY_ID') == $key ? 'selected' : "" }} value="{{ $key }}">{{ $nationality }}</option>
                                        @endforeach
                                    </select>
                                    @error('data.country_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>State</label>
                                    <select wire:model.live="data.state_id" onchange="triggerChange('data.state_id', this, true)" class="form-control">
                                        <option selected value="">-Select State-</option>
                                        @foreach($states as $key => $state)
                                            <option value="{{ $key }}">{{ $state }}</option>
                                        @endforeach
                                    </select>
                                    @error('data.state_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Sex</label>
                                    <select wire:model="data.gender_id" class="form-control" onchange="triggerChange('data.gender_id', this, false)">
                                        <option selected value="">-Select Sex-</option>
                                        @foreach($genders as $key => $gender)
                                            <option value="{{ $key }}">{{ $gender }}</option>
                                        @endforeach
                                    </select>
                                    @error('data.gender_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>LGA</label>
                                    <select class="form-control" wire:model="data.local_govt_id" onchange="triggerChange('data.local_govt_id', this, false)">
                                        <option selected value="">-Select LGA-</option>
                                        @foreach($lgas as $key => $lga)
                                            <option value="{{ $key }}">{{ $lga }}</option>
                                        @endforeach
                                    </select>
                                    @error('data.local_govt_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Religion</label>
                                    <select class="form-control"  wire:model="data.religion_id" onchange="triggerChange('data.religion_id', this, false)">
                                        <option selected value="">-Religion-</option>
                                        @foreach($religions as $key => $religion)
                                            <option value="{{ $key }}">{{ $religion }}</option>
                                        @endforeach
                                    </select>
                                    @error('data.religion_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Place of Birth</label>
                                    <input wire:model="data.place_of_birth" type="text" class="form-control">
                                    @error('data.place_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Contact Address</label>
                                    <input wire:model="data.contact_address" type="text" class="form-control">
                                    @error('data.contact_address') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Date Of Birth</label>
                                    <input wire:model="data.dob" type="date" class="form-control">
                                    @error('data.dob') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <span type="text" class="form-control">{{ auth('student')->user()->email }}</span>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" wire:model="data.phone" class="form-control">
                                    @error('data.phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Disability</label>
                                    <select class="form-control" wire:model="data.disability" onchange="triggerChange('data.disability', this, false)">
                                        <option value="">-Select Disability-</option>
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                    </select>
                                    @error('data.disability') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Nature of Disability</label>
                                    <input type="text" wire:model="data.nature_disability" class="form-control">
                                    @error('data.nature_disability') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>NIN</label>
                                    <input type="text" wire:model="data.nin" class="form-control">
                                    @error('data.nin') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Blood Group</label>
                                    <select class="form-control" wire:model="data.blood_group" onchange="triggerChange('data.blood_group', this, false)">
                                        <option selected value="">-Blood Group-</option>
                                        <option>A+ (A Positive)</option>
                                        <option>A- (A Negative)</option>
                                        <option>B+ (B Positive)</option>
                                        <option>B- (B Negative)</option>
                                        <option>AB+ (AB Positive)</option>
                                        <option>AB- (AB Negative)</option>
                                        <option>O+ (O Positive)</option>
                                        <option>O- (O Negative)</option>
                                    </select>
                                    @error('data.blood_group') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                        </div>
                        <h5 class="card-title mt-3">Guardian Details</h5>
                        <div class="row mt-3">
                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input wire:model="data.guardian_name" type="text" class="form-control">
                                    @error('data.guardian_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input wire:model="data.guardian_address" type="text" class="form-control">
                                    @error('data.guardian_address') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input wire:model="data.guardian_phone" type="text" class="form-control">
                                    @error('data.guardian_phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="text" wire:model="data.guardian_email" class="form-control">
                                    @error('data.guardian_email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div  class="col-sm-12 col-12 col-lg-12">
                                <div class="form-group">
                                    <label>Relationship</label>
                                    <select class="form-control" wire:model="data.guardian_relationship" onchange="triggerChange('data.guardian_relationship', this, false)">
                                        <option selected value="">-Relationship-</option>
                                        <option>Father</option>
                                        <option>Mother</option>
                                        <option>Brother</option>
                                        <option>Sister</option>
                                        <option>Son</option>
                                        <option>Daughter</option>
                                        <option>Husband</option>
                                        <option>Wife</option>
                                        <option>Others</option>
                                    </select>
                                    @error('data.guardian_relationship') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <h5 class="card-title mt-3">Next Of Kin Details</h5>
                        <div class="row mt-3">
                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input wire:model="data.kin_name" type="text" class="form-control">
                                    @error('data.kin_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input wire:model="data.kin_address" type="text" class="form-control">
                                    @error('data.kin_address') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input wire:model="data.kin_phone_no" type="text" class="form-control">
                                    @error('data.kin_phone_no') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input wire:model="data.kin_email" type="text" class="form-control">
                                    @error('data.kin_email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div  class="col-sm-12 col-12 col-lg-12">
                                <div class="form-group">
                                    <label>Relationship</label>
                                    <select class="form-control" wire:model="data.kin_relationship" onchange="triggerChange('data.kin_relationship', this, false)">
                                        <option selected value="">-Relationship-</option>
                                        <option>Father</option>
                                        <option>Mother</option>
                                        <option>Brother</option>
                                        <option>Sister</option>
                                        <option>Son</option>
                                        <option>Daughter</option>
                                        <option>Husband</option>
                                        <option>Wife</option>
                                    </select>
                                    @error('data.kin_relationship') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12 text-center">
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
