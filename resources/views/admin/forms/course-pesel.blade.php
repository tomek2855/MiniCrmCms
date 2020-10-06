<div class="form-group row">
    <label class="col-sm-2 col-form-label text-right">Data urodzenia (z PESELu)</label>
    <div class="form-group row col-sm-7">
        <input id="birthDateFromPESEL" class="form-control form-control-user" placeholder="Data urodzenia (z PESELu)">
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label text-right">Płeć (z PESELu)</label>
    <div class="form-group row col-sm-7">
        <input id="genderFromPESEL" class="form-control form-control-user" placeholder="Płeć (z PESELu)">
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            let pesel = '{{ $data->pesel }}';
            let decoded = PeselDecode(pesel);

            $('#birthDateFromPESEL').val(decoded.date);
            $('#genderFromPESEL').val(decoded.sex);
        });

        function PeselDecode(pesel)
        {
            // http://artpi.pl/?p=8
            var rok=parseInt(pesel.substring(0,2),10);
            var miesiac = parseInt(pesel.substring(2,4),10)-1;
            var dzien = parseInt(pesel.substring(4,6),10);
            if(miesiac>80) {
                rok = rok + 1800;
                miesiac = miesiac - 80;
            }
            else if(miesiac > 60) {
                rok = rok + 2200;
                miesiac = miesiac - 60;
            }
            else if (miesiac > 40) {
                rok = rok + 2100;
                miesiac = miesiac - 40;
            }
            else if (miesiac > 20) {
                rok = rok + 2000;
                miesiac = miesiac - 20;
            }
            else
            {
                rok += 1900;
            }
            var urodzony = dzien +'/'+ miesiac +'/'+ rok;

            var wagi = [9,7,3,1,9,7,3,1,9,7];
            var suma = 0;

            for(var i=0;i<wagi.length;i++) {
                suma+=(parseInt(pesel.substring(i,i+1),10) * wagi[i]);
            }
            suma=suma % 10;
            var valid=(suma===parseInt(pesel.substring(10,11),10));

            if(parseInt(pesel.substring(9,10),10) % 2 === 1) {
                var plec='Mężczyzna';
            } else {
                var plec='Kobieta';
            }
            return {valid:valid,sex:plec,date:urodzony};
        }
    </script>
@endpush
