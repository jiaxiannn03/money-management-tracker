<h1>Money Management Tracker</h1>
<h2>Balance: MYR {{ number_format($balance,2) }}</h2>

<a href="/add-transaction"><button>Add Transaction</button></a>

<!-- Income Section -->
<h3>Income Records</h3>
<table border="1" id="income-table">
    <thead>
        <tr>
            <th>Category</th>
            <th>Amount</th>
            <th>Currency</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- JS will populate -->
    </tbody>
</table>
<br>
<button id="income-prev">Prev</button>
<button id="income-next">Next</button>

<!-- Expense Section -->
<h3>Expense Records</h3>
<table border="1" id="expense-table">
    <thead>
        <tr>
            <th>Category</th>
            <th>Amount</th>
            <th>Currency</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- JS will populate -->
    </tbody>
</table>
<br>
<button id="expense-prev">Prev</button>
<button id="expense-next">Next</button>

<script>
const incomes = @json($incomes);
const expenses = @json($expenses);
const perPage = 8;

let incomePage = 0;
let expensePage = 0;

function renderTable(data, tableId, page) {
    const tbody = document.getElementById(tableId).querySelector('tbody');
    tbody.innerHTML = '';

    const start = page * perPage;
    const end = start + perPage;
    const pageData = data.slice(start, end);

    pageData.forEach(item => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.category}</td>
            <td>${parseFloat(item.amount).toFixed(2)}</td>
            <td>${item.currency}</td>
            <td>${item.trans_date}</td>
            <td>
                <a href="/edit-transaction/${item.id}">Edit</a>
                <form action="/delete-transaction/${item.id}" method="POST" style="display:inline;" 
                      onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        `;
        tbody.appendChild(row);
    });
}

// Initial render
renderTable(incomes, 'income-table', incomePage);
renderTable(expenses, 'expense-table', expensePage);

// Income buttons
document.getElementById('income-prev').addEventListener('click', () => {
    if(incomePage > 0) incomePage--;
    renderTable(incomes, 'income-table', incomePage);
});
document.getElementById('income-next').addEventListener('click', () => {
    if((incomePage + 1) * perPage < incomes.length) incomePage++;
    renderTable(incomes, 'income-table', incomePage);
});

// Expense buttons
document.getElementById('expense-prev').addEventListener('click', () => {
    if(expensePage > 0) expensePage--;
    renderTable(expenses, 'expense-table', expensePage);
});
document.getElementById('expense-next').addEventListener('click', () => {
    if((expensePage + 1) * perPage < expenses.length) expensePage++;
    renderTable(expenses, 'expense-table', expensePage);
});
</script>
