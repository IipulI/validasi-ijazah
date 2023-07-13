import { fetchApi } from "./main";
import { numberValidate } from "./main";

const tahunInput = document.getElementById('tahun-masuk')
const npmInput = document.getElementById('npm')
const select1 = document.getElementById('select-fakultas')
const select2 = document.getElementById('select-prodi')

if (window.location.href === window.location.protocol + '//' + window.location.host + '/mahasiswa/add'){
    var asli = document.createElement('option')
    asli.setAttribute('disabled', '')
    asli.setAttribute('selected', '')
    asli.text = '-Pilih Opsi-'

    select1.appendChild(asli)

    fetchApi('/api/fakultas').then((json) => {
        json.forEach(item => {
            var option = document.createElement("option")
            option.text = item.nama

            option.value = item.id_fakultas
            select1.appendChild(option)
        })
    })
}else {
    const buttonIjazah = document.getElementById('btn-ijazah')
    buttonIjazah.addEventListener('click', function () {
        document.getElementById('form-add-ijazah').scrollIntoView()
    })
}

select1.addEventListener('input', function (){
    while (select2.childNodes.length > 1) {
        select2.removeChild(select2.lastChild);
    }

    var asli = document.createElement('option')
    asli.setAttribute('disabled', '')
    asli.setAttribute('selected', '')
    asli.text = '-Pilih Opsi-'

    select2.appendChild(asli)

    fetchApi('/api/prodi?fakultas=' + this.value).then((json) => {
        json.forEach(item => {
            var option = document.createElement("option")
            option.text = item.nama
            option.value = item.id_program_studi

            select2.appendChild(option)
        })

        select2.disabled  = false
        select2.classList.remove('cursor-not-allowed')
    })
})

numberValidate(tahunInput, 'input')
numberValidate(npmInput, 'input')
