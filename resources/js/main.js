export async function fetchApi(url = ""){
    const response  =  await fetch(url, {
        method: "GET",
        headers: {
            "Content-Type" : 'application/json'
        }
    })

    return response.json()
}

export function numberValidate(params, type){
    params.addEventListener(type, function (){
        this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
    })

}

document.onreadystatechange = function () {
    var state = document.readyState
    if (state === 'complete') {
        document.getElementById('interactive');
        document.getElementById('load').style.visibility="hidden";
    }
}
