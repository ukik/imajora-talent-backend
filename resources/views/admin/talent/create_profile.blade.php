<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header">
                <h3>Lengkapi Profile</h3>
            </div>
            <div class="card-body">

                <form action="{{ url('/admin/talent/store/' . Auth::user()->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="name"
                                    class="form-control  @error('name') is-invalid @enderror"
                                    placeholder="Nama Lengkap.." value="{{ Auth::user()->name }}" required readonly>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email"
                                    class="form-control  @error('email') is-invalid @enderror" placeholder="Email.."
                                    value="{{ Auth::user()->email }}" required readonly>
                                <a href="{{ url('/admin/profile/' . Auth::user()->email . '/edit') }}"
                                    class="btn-text float-right">Settings</a>
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="number" name="phone"
                                    class="form-control  @error('phone') is-invalid @enderror"
                                    placeholder="Phone Number.." value="{{ old('phone', Auth::user()->phone) }}"
                                    required>
                                @error('phone')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control  @error('gender') is-invalid @enderror text-capitalize"
                                    name="gender" required>
                                    <option value="">- Select Gender -</option>
                                    @foreach ($genders as $gender)
                                        @if (old($gender->title, Auth::user()->gender) == $gender->title)
                                            <option value="{{ $gender->title }}" class="text-capitalize" selected>
                                                {{ $gender->title }}
                                            @else
                                            <option value="{{ $gender->title }}" class="text-capitalize">
                                                {{ $gender->title }}
                                        @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('gender')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Country / Negara</label>
                                <div class="select2-input select2-primary">
                                    <select id="select_country" name="country"
                                        class="form-control  @error('country') is-invalid @enderror" required>
                                        @if (old('country', Auth::user()->country))
                                            <option value="{{ Auth::user()->country }}" selected>
                                                {{ Auth::user()->country }}
                                            </option>
                                        @endif
                                    </select>
                                </div>
                                @error('country')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>City / Kota</label>
                                <input type="text" name="city"
                                    class="form-control  @error('city') is-invalid @enderror" placeholder="City / Kota"
                                    required value="{{ old('city', Auth::user()->city) }}">
                                @error('city')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label>Skills</label>
                                <div class="select2-input select2-primary">
                                    <select id="select_talent_skill" name="skill[]" class="form-control" multiple>
                                        @if (old('skill', Auth::user()->skills))
                                            @foreach (old('skill', Auth::user()->skills) as $skill)
                                                <option value="{{ $skill->id }}" selected>{{ $skill->title }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @error('skill')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Create New Skill</label>
                                <br>
                                <a href="{{ route('skill.create') }}" class="btn btn-primary btn-round">
                                    <i class="fas fa-plus"></i>
                                    Skill
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control  @error('description') is-invalid @enderror" rows="3" required>{{ old('description', Auth::user()->description) }}</textarea>
                                @error('description')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="float-right">
                                <button type="submit" name="status" value="non-active" class="btn btn-info btn-round">
                                    Draft
                                </button>
                                <button type="submit" name="status" value="active" class="btn btn-primary btn-round">
                                    Apply
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $('#select_country').select2({
            theme: "bootstrap",
            language: "",
            allowClear: true,
            ajax: {
                url: "{{ route('select.country') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.name
                            }
                        })
                    };
                }
            }
        });
    </script>
    <script>
        $('#select_talent_skill').select2({
            theme: "bootstrap",
            language: "",
            allowClear: true,
            ajax: {
                url: "{{ route('select.skill') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.title,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
    </script>
@endpush
