@extends('Layout.layout')
@section('content')
    <div class="page-header mb-4">
        <h1 class="page-title mb-2">Select2 - Advanced Select</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active">Select2</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Basic Select2</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Single Select</label>
                        <select class="form-select select2-basic" id="basicSelect">
                            <option></option>
                            <option value="1">United States</option>
                            <option value="2">United Kingdom</option>
                            <option value="3">Canada</option>
                            <option value="4">Australia</option>
                            <option value="5">Germany</option>
                            <option value="6">France</option>
                            <option value="7">Spain</option>
                            <option value="8">Italy</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">With Placeholder</label>
                        <select class="form-select select2-placeholder" id="placeholderSelect">
                            <option></option>
                            <option value="technology">Technology</option>
                            <option value="business">Business</option>
                            <option value="health">Health</option>
                            <option value="education">Education</option>
                            <option value="sports">Sports</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Multiple Select</label>
                        <select class="form-select select2-multiple" multiple id="multipleSelect">
                            <option value="javascript">JavaScript</option>
                            <option value="python">Python</option>
                            <option value="java">Java</option>
                            <option value="csharp">C#</option>
                            <option value="php">PHP</option>
                            <option value="ruby">Ruby</option>
                            <option value="go">Go</option>
                            <option value="rust">Rust</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Select2 with Search</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Searchable Dropdown</label>
                        <select class="form-select select2-search" id="searchSelect">
                            <option></option>
                            <optgroup label="North America">
                                <option value="us">United States</option>
                                <option value="ca">Canada</option>
                                <option value="mx">Mexico</option>
                            </optgroup>
                            <optgroup label="Europe">
                                <option value="uk">United Kingdom</option>
                                <option value="fr">France</option>
                                <option value="de">Germany</option>
                                <option value="es">Spain</option>
                                <option value="it">Italy</option>
                            </optgroup>
                            <optgroup label="Asia">
                                <option value="jp">Japan</option>
                                <option value="cn">China</option>
                                <option value="in">India</option>
                                <option value="kr">South Korea</option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Max Selection (3 items)</label>
                        <select class="form-select select2-max" multiple id="maxSelect">
                            <option value="red">Red</option>
                            <option value="blue">Blue</option>
                            <option value="green">Green</option>
                            <option value="yellow">Yellow</option>
                            <option value="purple">Purple</option>
                            <option value="orange">Orange</option>
                            <option value="pink">Pink</option>
                            <option value="black">Black</option>
                        </select>
                        <small class="text-muted">You can select maximum 3 items</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Advanced Features</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Tags Mode (Create New Options)</label>
                        <select class="form-select select2-tags" multiple id="tagsSelect">
                            <option value="html">HTML</option>
                            <option value="css">CSS</option>
                            <option value="javascript">JavaScript</option>
                        </select>
                        <small class="text-muted">Type to create new tags</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Disabled Options</label>
                        <select class="form-select select2-disabled" id="disabledSelect">
                            <option></option>
                            <option value="1">Available Option 1</option>
                            <option value="2" disabled>Disabled Option</option>
                            <option value="3">Available Option 2</option>
                            <option value="4" disabled>Another Disabled</option>
                            <option value="5">Available Option 3</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Clear Selection</label>
                        <select class="form-select select2-clear" id="clearSelect">
                            <option></option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                        <small class="text-muted">Click X to clear selection</small>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">With Icons & Images</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Select User</label>
                        <select class="form-select select2-template" id="templateSelect">
                            <option></option>
                            <option value="1" data-icon="bi-person-circle">John Doe</option>
                            <option value="2" data-icon="bi-person-circle">Jane Smith</option>
                            <option value="3" data-icon="bi-person-circle">Mike Johnson</option>
                            <option value="4" data-icon="bi-person-circle">Sarah Williams</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">User Registration Form Example</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Full Name *</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Country *</label>
                        <select class="form-select select2-country" required id="countrySelect">
                            <option></option>
                            <option value="us">United States</option>
                            <option value="uk">United Kingdom</option>
                            <option value="ca">Canada</option>
                            <option value="au">Australia</option>
                            <option value="de">Germany</option>
                            <option value="fr">France</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Language *</label>
                        <select class="form-select select2-language" required id="languageSelect">
                            <option></option>
                            <option value="en">English</option>
                            <option value="es">Spanish</option>
                            <option value="fr">French</option>
                            <option value="de">German</option>
                            <option value="zh">Chinese</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Skills</label>
                    <select class="form-select select2-skills" multiple id="skillsSelect">
                        <option value="frontend">Frontend Development</option>
                        <option value="backend">Backend Development</option>
                        <option value="fullstack">Full Stack Development</option>
                        <option value="mobile">Mobile Development</option>
                        <option value="devops">DevOps</option>
                        <option value="design">UI/UX Design</option>
                        <option value="database">Database Management</option>
                        <option value="cloud">Cloud Computing</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Interests (Tags)</label>
                    <select class="form-select select2-interests" multiple id="interestsSelect">
                        <option value="coding">Coding</option>
                        <option value="reading">Reading</option>
                        <option value="travel">Travel</option>
                        <option value="photography">Photography</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-2"></i>Submit Registration
                </button>
                <button type="reset" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-2"></i>Reset
                </button>
            </form>
        </div>
    </div>
@endsection
