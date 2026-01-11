<form action='/add-transaction' method='post'>
    @csrf
    <label for='trans_type'>Transaction Type:</label>
    <select id="trans_type" name="trans_type" required>
        <option value="income">Income</option>
        <option value="expense">Expense</option>
    </select><br>

    <label for='category'>Category:</label>
        <select id="category" name="category" required>
            
        </select>

        <br>
    <label for='amount'>Amount:</label>
    <input type="number" name="amount" step="0.01" min="0.01" required>
    <select id='currency'  name='currency' required>
        <option value='myr'>MYR</option>
        <option value='usd'>USD</option>
        <option value='sgd'>SGD</option>
        <option value='cny'>CNY</option>
    </select>

    <br>
    <label for='trans_date'>Transaction Date:</label>
    <input type='date' id='trans_date' name='trans_date' max="{{ date('Y-m-d') }}" required>

    <br>
    <button type="submit">Add Transaction Record</button>

</form>
<script>
const incomeCat=['Salary','Angpao','Sales'];
const expenseCat=['Shopping','Food','Rental','Loan','Travel'];
const typeElement=document.getElementById('trans_type');
const catElement=document.getElementById('category');

function chooseCategory(){
    const type=typeElement.value;
    catElement.innerHTML='';
    const category=type==='income'?incomeCat:expenseCat;
    category.forEach(cat=>{
        const option=document.createElement('option');
        option.value=cat;
        option.textContent=cat;
        catElement.appendChild(option);
    })
}
typeElement.addEventListener('change',chooseCategory);
chooseCategory();
</script>





    

