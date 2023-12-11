$(document).ready(function () {
  $(".hour").click(function() {
    $(".flatpickr-minute").prop("disabled", true);
  });

  const searchParams = new URLSearchParams(window.location.search);
  const hasDate = searchParams.has('date');

  $(".date").flatpickr({
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "l, d F Y",
    maxDate: flatpickr.formatDate(new Date(), "Y-m-d"),
    clickOpens: !hasDate
  });

  $(".hour").flatpickr({
    enableTime: true,
    noCalendar: true,
    time_24hr: true,
    manualInput: false,
    defaultHour: 0,
    dateFormat: "H:i:S",
    minuteIncrement: 15,
  });
});
