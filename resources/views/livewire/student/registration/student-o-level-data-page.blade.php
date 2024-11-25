<div id="category-2-part" style="margin-bottom: 30px;">
    <div class="container">
        <div class="card">
            <form wire:submit.prevent="store">
                <div class="card-body">
                    <h5 class="card-title">Student O-Level Details Page</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Please complete the required information below</h6>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-12 col-lg-12">
                                <div class="form-group">
                                    <label>Number Of Sittings</label>
                                    <select wire:model="sittings" onchange="triggerChange('sittings', this, false)" class="form-control sittings">
                                        <option value="">Select Number Of Sittings</option>
                                        <option value="1">One Sittings</option>
                                        <option value="2">Two Sittings</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-6 col-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>1st Sitting Exam Type</th>
                                        <th>
                                            <select wire:model="firstSitting.examType" onchange="triggerChange('firstSitting.examType', this, false)" class="form-control">
                                                <option value="">Select Exam Type</option>
                                                <option value="WAEC">WAEC</option>
                                                <option value="NECO">NECO</option>
                                                <option value="NABTEB">NABTEB</option>
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>1st Sitting Exam Number</th>
                                        <th><input wire:model="firstSitting.examNumber"  class="form-control" type="text" ></th>
                                    </tr>
                                    <tr>
                                        <th>1st Sitting Exam Year</th>
                                        <th><input wire:model="firstSitting.examYear" class="form-control" type="text" ></th>
                                    </tr>
                                </table>
                                <table class="table table-info table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Subjects</th>
                                        <th>Grades</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for($i = 1; $i <= 9; $i++)
                                        @php
                                            $compulsory = null;
                                             if(isset($first_sittings_compulsory[count($first_sittings_compulsory) -1])) {
                                                 $compulsory = $first_sittings_compulsory[count($first_sittings_compulsory) -1];
                                                 unset($first_sittings_compulsory[count($first_sittings_compulsory) -1]);
                                             }
                                        @endphp
                                        <tr>
                                            <td>
                                                @if(is_null($compulsory))
                                                    <select wire:model="firstSitting.{{ $i }}.subject" onchange="triggerChange('firstSitting.{{ $i }}.subject', this, false)" class="form-control">
                                                        <option value="">Select Subject</option>
                                                        @foreach($subjects as $subject)
                                                            <option {{ ($compulsory !== NULL and $compulsory == $subject['id']) ? "selected" : "" }} value="{{ $subject['id'] }}">{{ $subject['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select disabled class="form-control">
                                                        <option value="">Select Subject</option>
                                                        @foreach($subjects as $subject)
                                                            <option {{ ($compulsory !== NULL and $compulsory == $subject['id']) ? "selected" : "" }} value="{{ $subject['id'] }}">{{ $subject['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" wire:model="firstSitting.{{ $i }}.subject">
                                                @endif
                                            </td>
                                            <td>
                                                <select wire:model="firstSitting.{{ $i }}.grade" onchange="triggerChange('firstSitting.{{ $i }}.grade', this, false)" class="form-control">
                                                    <option value="">-Select Grade-</option>
                                                    <option>A1</option>
                                                    <option>B2</option>
                                                    <option>B3</option>
                                                    <option>C4</option>
                                                    <option>C5</option>
                                                    <option>C6</option>
                                                    <option>D7</option>
                                                    <option>E8</option>
                                                    <option>F9</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                            <div id="secondSitting" style="display: none" class="col-sm-6 col-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>2nd Sitting Exam Type</th>
                                        <th>
                                            <select wire:model="secondSitting.examType" onchange="triggerChange('secondSitting.examType', this, false)" class="form-control">
                                                <option value="">Select Exam Type</option>
                                                <option value="WAEC">WAEC</option>
                                                <option value="NECO">NECO</option>
                                                <option value="NABTEB">NABTEB</option>
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>2nd Sitting Exam Number</th>
                                        <th><input wire:model="secondSitting.examNumber"  class="form-control" type="text" ></th>
                                    </tr>
                                    <tr>
                                        <th>2nd Sitting Exam Year</th>
                                        <th><input wire:model="secondSitting.examYear" class="form-control" type="text" ></th>
                                    </tr>
                                </table>
                                <table class="table table-info table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Subjects</th>
                                        <th>Grades</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for($i = 1; $i <= 9; $i++)
                                        @php
                                            $compulsory = null;
                                             if(isset($second_sittings_compulsory[count($second_sittings_compulsory) -1])) {
                                                 $compulsory = $second_sittings_compulsory[count($second_sittings_compulsory) -1];
                                                 unset($second_sittings_compulsory[count($second_sittings_compulsory) -1]);
                                             }
                                        @endphp
                                        <tr>
                                            <td>
                                                @if(is_null($compulsory))
                                                    <select wire:model="secondSitting.{{ $i }}.subject" onchange="triggerChange('secondSitting.{{ $i }}.subject', this, false)" class="form-control">
                                                        <option value="">Select Subject</option>
                                                        @foreach($subjects as $subject)
                                                            <option {{ ($compulsory !== NULL and $compulsory == $subject['id']) ? "selected" : "" }} value="{{ $subject['id'] }}">{{ $subject['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select disabled class="form-control">
                                                        <option value="">Select Subject</option>
                                                        @foreach($subjects as $subject)
                                                            <option {{ ($compulsory !== NULL and $compulsory == $subject['id']) ? "selected" : "" }} value="{{ $subject['id'] }}">{{ $subject['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" wire:model="secondSitting.{{ $i }}.subject">
                                                @endif
                                            </td>
                                            <td>
                                                <select wire:model="secondSitting.{{ $i }}.grade" onchange="triggerChange('secondSitting.{{ $i }}.grade', this, false)" class="form-control">
                                                    <option value="">-Select Grade-</option>
                                                    <option>A1</option>
                                                    <option>B2</option>
                                                    <option>B3</option>
                                                    <option>C4</option>
                                                    <option>C5</option>
                                                    <option>C6</option>
                                                    <option>D7</option>
                                                    <option>E8</option>
                                                    <option>F9</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endfor
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
                            <button type="submit" class="btn btn-success btn-lg">Save Changes and Continue</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    window.addEventListener('load', function (){
        $(document).ready(function() {
            $('.sittings').on('change', function(){
                if($(this).val() == "2") {
                    $('#secondSitting').removeAttr('style');
                } else {
                    $('#secondSitting').attr('style', 'display: none');
                }
            });

            if($('.sittings').val() == "2") {
                $('#secondSitting').removeAttr('style');
            } else {
                $('#secondSitting').attr('style', 'display: none');
            }
        })
    });

    function triggerChange(name, obj, live) {
        @this.set(name, $(obj).val(), live);
    }

</script>
