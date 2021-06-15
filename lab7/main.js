function addElement(table_name){
    let t = document.getElementById(table_name);
    let index = t.rows.length;
    let row = t.insertRow(index);
    let cel_1 = row.insertCell(0);
    cel_1.innerHTML = `<label for="element${index}">№${index+1}</label>`;
    let cel_2 = row.insertCell(1);
    cel_2.innerHTML = `<input type="text" name="element${index}" id="element${index}">`;
    document.getElementById('arrLength').value = t.rows.length;
}