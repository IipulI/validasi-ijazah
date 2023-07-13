const npm = document.getElementById('npm')
const noijazah = document.getElementById('ijazah')
const token = document.getElementById('token').value
const button = document.getElementById('button');
const imgContainer = document.querySelectorAll('[aria-label="hidden-card"]')

const message = document.querySelector('[aria-label="message"]')

import {numberValidate} from "./main";

numberValidate(npm, 'input')
numberValidate(noijazah, 'input')


button.addEventListener('click', function (){
    fetch("/api/validate/ijazah",
        {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                    npm: npm.value,
                    no_ijazah: noijazah.value,
                    _token: token
                })
        })
        .then((response) => {
            if (!response.ok){
                toggleModal()
                imgContainer.forEach(div => {
                    div.classList.add("hidden")
                })
            } else if(response.ok){
                imgContainer.forEach(div => {
                    div.classList.remove("hidden")
                })
            }

            return response.json()
        })
        .then(function (json){
            document.getElementById('img-ijazah').src = location.protocol + '//' +  location.host + json.path_img
            message.textContent = json.message

            document.getElementById('nama').textContent = json.mahasiswa.nama
            document.getElementById('npm-data').textContent = json.mahasiswa.npm
            document.getElementById('tempat').textContent = json.mahasiswa.tempat_tanggal_lahir
            document.getElementById('tanggal-lahir').textContent = json.mahasiswa.tanggal_lahir
            document.getElementById('fakultas').textContent = 'Fakultas ' + json.mahasiswa.fakultas.nama
            document.getElementById('prodi').textContent = json.mahasiswa.prodi.nama
            document.getElementById('tahun-masuk').textContent = json.mahasiswa.tahun_masuk
            document.getElementById('status').textContent = json.mahasiswa.is_graduated === 1 ? 'Lulus' : 'Belum Lulus'
            document.getElementById('nomor-ijazah').textContent = json.no_ijazah

        })
})

const overlay = document.querySelector('.modal-overlay')
overlay.addEventListener('click', toggleModal)

var closemodal = document.querySelectorAll('.modal-close')
for (var i = 0; i < closemodal.length; i++) {
    closemodal[i].addEventListener('click', toggleModal)
}

function toggleModal () {
    const body = document.querySelector('body')
    const modal = document.querySelector('.modal')
    modal.classList.toggle('opacity-0')
    modal.classList.toggle('pointer-events-none')
    body.classList.toggle('modal-active')
}

document.onkeydown = function(evt) {
    evt = evt || window.event
    var isEscape = false
    if ("key" in evt) {
        isEscape = (evt.key === "Escape" || evt.key === "Esc")
    } else {
        isEscape = (evt.keyCode === 27)
    }
    if (isEscape && document.body.classList.contains('modal-active')) {
        toggleModal()
    }
};














