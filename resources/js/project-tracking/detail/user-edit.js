$(document).ready(function () {
  new AutoNumeric('.autonumeric', {
    allowDecimalPadding: false,
    decimalCharacter: ',',
    digitGroupSeparator: '.',
    unformatOnSubmit: true
  });

  const cost = $(".cost").data("value");
  $(".cost").val(cost.toLocaleString('id-ID'));

  function multiplyTimeByNumber(time, number) {
    // Mengonversi waktu ke dalam detik
    const timeArray = time.split(':');
    const seconds = (+timeArray[0]) * 60 * 60 + (+timeArray[1]) * 60 + (+timeArray[2]);

    // Menghitung perkalian
    const result = (seconds / 3600) * number;

    return result.toLocaleString('id-ID');
  }

  $(".rate-per-hour").keyup(function() {
    const hour = $(".hour").val();
    const rate = $(this).val().replaceAll(".", "");

    const cost = multiplyTimeByNumber(hour, rate);
    
    $(".cost").val(cost);
  });
});
