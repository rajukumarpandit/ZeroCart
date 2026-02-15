// Basic Date Picker
flatpickr("#basicDate", {
    dateFormat: "Y-m-d",
});

// Date with Default Value
flatpickr("#defaultDate", {
    dateFormat: "Y-m-d",
    defaultDate: "today",
});

// Date Range
flatpickr("#dateRange", {
    mode: "range",
    dateFormat: "Y-m-d",
});

// Time Picker
flatpickr("#timePicker", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true,
});

// Date & Time Picker
flatpickr("#dateTimePicker", {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
});

// Min & Max Date
const today = new Date();
const maxDate = new Date();
maxDate.setDate(maxDate.getDate() + 30);

flatpickr("#minMaxDate", {
    dateFormat: "Y-m-d",
    minDate: "today",
    maxDate: maxDate,
});

// Disable Weekends
flatpickr("#noWeekends", {
    dateFormat: "Y-m-d",
    disable: [
        function (date) {
            return date.getDay() === 0 || date.getDay() === 6;
        },
    ],
});

// Multiple Dates
flatpickr("#multipleDates", {
    mode: "multiple",
    dateFormat: "Y-m-d",
});

// Inline Calendar
flatpickr("#inlineCalendar", {
    inline: true,
    dateFormat: "Y-m-d",
});

// Check-in Date
const checkInPicker = flatpickr("#checkIn", {
    dateFormat: "Y-m-d",
    minDate: "today",
    onChange: function (selectedDates) {
        if (selectedDates.length > 0) {
            const minCheckOut = new Date(selectedDates[0]);
            minCheckOut.setDate(minCheckOut.getDate() + 1);
            checkOutPicker.set("minDate", minCheckOut);
        }
    },
});

// Check-out Date
const checkOutPicker = flatpickr("#checkOut", {
    dateFormat: "Y-m-d",
    minDate: "today",
});
