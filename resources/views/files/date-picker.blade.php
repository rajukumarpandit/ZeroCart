@extends('Layout.layout')
@section('content')
    <div class="page-header mb-4">
        <h1 class="page-title mb-2">Date & Time Pickers</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active">Date Picker</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Basic Date Picker</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Single Date</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                            <input type="text" class="form-control" id="basicDate" placeholder="Select date">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date with Default Value</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-check"></i></span>
                            <input type="text" class="form-control" id="defaultDate" placeholder="Select date">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date Range</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-range"></i></span>
                            <input type="text" class="form-control" id="dateRange" placeholder="Select date range">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Time Picker</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Time Only</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-clock"></i></span>
                            <input type="text" class="form-control" id="timePicker" placeholder="Select time">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date & Time</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                            <input type="text" class="form-control" id="dateTimePicker" placeholder="Select date & time">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Advanced Options</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Min & Max Date</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-minus"></i></span>
                            <input type="text" class="form-control" id="minMaxDate" placeholder="Next 30 days only">
                        </div>
                        <small class="text-muted">Only dates from today to 30 days ahead</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Disable Weekends</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-x"></i></span>
                            <input type="text" class="form-control" id="noWeekends" placeholder="Weekdays only">
                        </div>
                        <small class="text-muted">Weekends are disabled</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Multiple Dates</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-plus"></i></span>
                            <input type="text" class="form-control" id="multipleDates"
                                placeholder="Select multiple dates">
                        </div>
                        <small class="text-muted">You can select multiple dates</small>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Inline Calendar</h5>
                </div>
                <div class="card-body">
                    <div id="inlineCalendar"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Booking Form Example</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Check-in Date</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-box-arrow-in-right"></i></span>
                            <input type="text" class="form-control" id="checkIn"
                                placeholder="Select check-in date">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Check-out Date</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-box-arrow-right"></i></span>
                            <input type="text" class="form-control" id="checkOut"
                                placeholder="Select check-out date">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Number of Guests</label>
                        <select class="form-select">
                            <option>1 Guest</option>
                            <option>2 Guests</option>
                            <option>3 Guests</option>
                            <option>4+ Guests</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Room Type</label>
                        <select class="form-select">
                            <option>Standard Room</option>
                            <option>Deluxe Room</option>
                            <option>Suite</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-2"></i>Check Availability
                </button>
            </form>
        </div>
    </div>
@endsection
