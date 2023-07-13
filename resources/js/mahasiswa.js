import { fetchApi } from "./main";

const table = document.getElementById('mahasiswa')
const next = document.getElementById('next2')
const previous = document.getElementById('previous')
const add = document.getElementById('add-mahasiswa')
const buttons = document.querySelectorAll('[aria-label="page-buttons"]')
const curPage = document.getElementById('curPage')


add.addEventListener('click', function (){
    window.location.href = '/mahasiswa/add'
})

var div_array = [...buttons]; // converts NodeList to Array
div_array.forEach(button => {
    button.addEventListener('click', function (){
        fetchApi(this.value).then((json) => {
            var bodyRef = table.getElementsByTagName('tbody')[0];
            bodyRef.innerHTML = ''
            bodyRef.classList.add("table-divide-color", "table-divide")

            previous.value = json.prev_page_url
            next.value = json.next_page_url

            curPage.innerHTML = json.current_page

            tableInsert(json)
        })
    })
});

fetchApi('/api/mahasiswa').then((json) => {
    var bodyRef = table.getElementsByTagName('tbody')[0];
    bodyRef.innerHTML = ''
    bodyRef.classList.add("table-divide-color", "table-divide")

    previous.value = json.prev_page_url
    next.value = json.next_page_url

    curPage.innerHTML = json.current_page

    tableInsert(json)
})

function tableInsert(json){
    json.data.forEach(item => {
        var insert = table.getElementsByTagName('tbody')[0].insertRow()
        var cell1 = insert.insertCell(0)
        var cell2 = insert.insertCell(1)
        var cell3 = insert.insertCell(2)
        var cell4 = insert.insertCell(3)
        var cell5 = insert.insertCell(4)
        var cell6 = insert.insertCell(5)
        var cell7 = insert.insertCell(6)


        cell1.innerHTML = item.nama
        cell1.classList.add("sm:pl-0", "text-gray-500", "font-semibold", "text-sm", "pr-3", "pl-4", "py-4", "whitespace-nowrap")

        cell2.innerHTML = item.npm
        cell2.classList.add("text-gray-500", "text-sm", "py-4", "px-3", "whitespace-nowrap")

        cell3.innerHTML = item.email
        cell3.classList.add("text-gray-500", "text-sm", "py-4", "px-3", "whitespace-nowrap")

        cell4.innerHTML = item.tahun_masuk
        cell4.classList.add("text-gray-500", "text-sm", "py-4", "px-3", "whitespace-nowrap")

        cell5.innerHTML = item.is_graduated === 1 ? "Lulus" : "Belum Lulus"
        cell5.classList.add("text-gray-500", "text-sm", "py-4", "px-3", "whitespace-nowrap")

        cell6.innerHTML = item.ijazah != null ? "Ada" : "Belum Ada"
        cell6.classList.add("text-gray-500", "text-sm", "py-4", "px-3", "whitespace-nowrap")

        cell7.classList.add("pr-0", "font-semibold", "text-sm", "text-right", "pr-4", "pl-3", "py-4", "whitespace-nowrap", "relative")
        cell7.innerHTML = ("<a href='/mahasiswa/detail?npm="+item.npm+"'  class='px-2 text-indigo-500 hover:text-indigo-700' >Detail </a>")
    })
}

//<button aria-label='delete-mahasiswa' value='del-"+item.npm+"' class='px-2 text-red-500 hover:text-red-700'>Delete</button>
