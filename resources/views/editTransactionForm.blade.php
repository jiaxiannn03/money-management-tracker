<form action="/edit-transaction/{{$transaction->id}}" method="post">
    @csrf
    <label for="trans_type">Transaction Type:</label>
    <select id="trans_type" name="trans_type" required>
        <option value="income" {{$transaction->trans_type=='income' ? 'selected':'' }}>
            Income</option>
        <option value="expense" {{ $transaction->trans_type== 'expense'?'selected':'' }}>
            Expense
        </option>
    </select><br>

    <label for="category">Category:</label>
    <select id="category" name="category" required>

    </select>
    <br>
    <label for="amount">Amount:</label>
    <input type="number" name="amount" step="0.01" min="0.01" value="{{ $transaction->amount }}" required>

    <select id="currency" name="currency" required>
        <option value="myr" {{ strtolower($transaction->currency) == 'myr' ? 'selected' : '' }}>MYR</option>
        <option value="usd" {{ strtolower($transaction->currency) == 'usd' ? 'selected' : '' }}>USD</option>
        <option value="sgd" {{ strtolower($transaction->currency) == 'sgd' ? 'selected' : '' }}>SGD</option>
        <option value="cny" {{ strtolower($transaction->currency) == 'cny' ? 'selected' : '' }}>CNY</option>
    </select><br>

    <label for="trans_date">Transaction Date:</label>
    <input type="date" id="trans_date" name="trans_date" value="{{ $transaction->trans_date }}" max="{{ date('Y-m-d') }}" required>

    <br>
    <button type="submit">Update Transaction Record</button>
</form>
<script>
const incomeCat=['Salary','Angpao','Sales'];
const expenseCat=['Shopping','Food','Rental','Loan','Travel'];

const typeElement=document.getElementById('trans_type');
const catElement=document.getElementById('category');

const currentCat="{{$transaction->category}}";

function chooseCategory(){
    const type=typeElement.value;
    catElement.innerHTML='';
    const category=type ==='income'?incomeCat:expenseCat;

    category.forEach(cat=>{
        const option = document.createElement('option');
        option.value = cat;
        option.textContent = cat;

        if (cat === currentCat){
            option.selected=true;
        }

        catElement.appendChild(option);
    });
}

typeElement.addEventListener('change', chooseCategory);
chooseCategory();
</script>
