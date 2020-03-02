<?php


Route::get('/home', 'HomeController@index')->name('home');


// Dashboard
Route::get('/dashboard', 'Personal\DashboardController@dashboard')->name('personal.dashboard');


// Profile
Route::get('/profile', 'Personal\ProfileController@profile')->name('personal.profile');
Route::get('/profile/update/{profile_id}', 'Personal\ProfileController@profileUpdate')->name('personal.profile.update');


//Calendar
Route::get('/calendar', 'Personal\CalendarController@calendar')->name('personal.calendar');
Route::post('/calendar/store', 'Personal\CalendarController@calendarStore')->name('personal.calendar.store');
Route::post('/calendar/update/{calendar_id}', 'Personal\CalendarController@calendarUpdate')->name('personal.calendar.update');


// To Do
Route::get('/to/dos', 'Personal\ToDoController@toDos')->name('personal.to.dos');
Route::post('/to/do/store', 'Personal\ToDoController@toDoStore')->name('personal.to.do.store');
Route::post('/to/do/update/{todo_id}', 'Personal\ToDoController@toDoUpdate')->name('personal.to.do.update');
Route::get('/to/do/set/in/progress/{todo_id}', 'Personal\ToDoController@toDoSetInProgress')->name('personal.to.do.set.in.progress');
Route::get('/to/do/set/completed/{todo_id}', 'Personal\ToDoController@toDoSetCompleted')->name('personal.to.do.set.completed');
Route::get('/to/do/delete/{todo_id}', 'Personal\ToDoController@toDoDelete')->name('personal.to.do.delete');

// Contacts
Route::get('/contacts', 'Personal\CRMController@contacts')->name('personal.contacts');
Route::get('/contact/create', 'Personal\CRMController@contactCreate')->name('personal.contact.create');
Route::post('/contact/store', 'Personal\CRMController@contactStore')->name('personal.contact.store');
Route::get('/contact/show/{contact_id}', 'Personal\CRMController@contactShow')->name('personal.contact.show');

Route::get('/contact/liability/create/{contact_id}', 'Personal\CRMController@contactLiabilityCreate')->name('personal.contact.liability.create');
Route::get('/contact/loan/create/{contact_id}', 'Personal\CRMController@contactLoanCreate')->name('personal.contact.loan.create');
Route::get('/contact/sale/create/{contact_id}', 'Personal\CRMController@contactSaleCreate')->name('personal.contact.sale.create');

Route::post('/contact/update/{contact_id}', 'Personal\CRMController@contactUpdate')->name('personal.contact.update');
Route::get('/contact/delete/{contact_id}', 'Personal\CRMController@contactDelete')->name('personal.contact.delete');
Route::get('/contact/restore/{contact_id}', 'Personal\CRMController@contactRestore')->name('personal.contact.restore');

Route::get('/contact/update/lead/to/contact/{contact_id}', 'Personal\CRMController@contactUpdateLeadToContact')->name('personal.contact.update.lead.to.contact');
Route::post('/contact/contact/type/store/{contact_id}', 'Personal\CRMController@contactContactTypeStore')->name('personal.contact.contact.type.store');



// Income
Route::get('/income', 'Personal\IncomeController@income')->name('personal.income');
Route::get('/income/create', 'Personal\IncomeController@incomeCreate')->name('personal.income.create');
Route::post('/income/store', 'Personal\IncomeController@incomeStore')->name('personal.income.store');
Route::get('/income/show/{income_id}', 'Personal\IncomeController@incomeShow')->name('personal.income.show');
Route::get('/income/edit/{income_id}', 'Personal\IncomeController@incomeEdit')->name('personal.income.edit');
Route::post('/income/update/{income_id}', 'Personal\IncomeController@incomeUpdate')->name('personal.income.update');
Route::get('/income/delete/{income_id}', 'Personal\IncomeController@incomeDelete')->name('personal.income.delete');


// Budget
Route::get('/budget', 'Personal\BudgetController@budget')->name('personal.budget');
Route::get('/budget/create', 'Personal\BudgetController@budgetCreate')->name('personal.budget.create');
Route::post('/budget/store', 'Personal\BudgetController@budgetStore')->name('personal.budget.store');
Route::get('/budget/show/{budget_id}', 'Personal\BudgetController@budgetShow')->name('personal.budget.show');
Route::get('/budget/edit/{budget_id}', 'Personal\BudgetController@budgetEdit')->name('personal.budget.edit');
Route::post('/budget/update/{budget_id}', 'Personal\BudgetController@budgetUpdate')->name('personal.budget.update');
Route::get('/budget/delete/{budget_id}', 'Personal\BudgetController@budgetDelete')->name('personal.budget.delete');


// Asset
Route::get('/assets', 'Personal\AssetController@assets')->name('personal.assets');
Route::post('/asset/create', 'Personal\AssetController@assetCreate')->name('personal.asset.create');
Route::post('/asset/store', 'Personal\AssetController@assetStore')->name('personal.asset.store');
Route::get('/asset/show/{asset_id}', 'Personal\AssetController@assetShow')->name('personal.asset.show');
Route::get('/asset/edit/{asset_id}', 'Personal\AssetController@assetEdit')->name('personal.asset.edit');
Route::post('/asset/update/{asset_id}', 'Personal\AssetController@assetUpdate')->name('personal.asset.update');
Route::get('/asset/delete/{asset_id}', 'Personal\AssetController@assetDelete')->name('personal.asset.delete');


// Sacco
Route::get('/saccos', 'Personal\SaccoController@saccos')->name('personal.saccos');
Route::get('/sacco/create', 'Personal\SaccoController@saccoCreate')->name('personal.sacco.create');
Route::post('/sacco/store', 'Personal\SaccoController@saccoStore')->name('personal.sacco.store');
Route::get('/sacco/show/{sacco_id}', 'Personal\SaccoController@saccoShow')->name('personal.sacco.show');
Route::get('/sacco/contributions/{sacco_id}', 'Personal\SaccoController@saccoContributions')->name('personal.sacco.contributions');
Route::get('/sacco/contribution/{contribution_id}', 'Personal\SaccoController@saccoContributionShow')->name('personal.sacco.contribution');
Route::get('/sacco/contribution/create/{sacco_id}', 'Personal\SaccoController@saccoContributionCreate')->name('personal.sacco.contribution.create');
Route::get('/sacco/contribution/store/{sacco_id}', 'Personal\SaccoController@saccoContributionStore')->name('personal.sacco.contribution.store');
Route::get('/sacco/contribution/update/{contribution_id}', 'Personal\SaccoController@saccoContributionUpdate')->name('personal.sacco.contribution.update');
Route::get('/sacco/contribution/delete/{contribution_id}', 'Personal\SaccoController@saccoContributionDelete')->name('personal.sacco.contribution.delete');
Route::get('/sacco/members/{sacco_id}', 'Personal\SaccoController@saccoMembers')->name('personal.sacco.members');
Route::get('/sacco/member/show/{sacco_id}', 'Personal\SaccoController@saccoMemberShow')->name('personal.sacco.member.show');
Route::get('/sacco/member/create/{sacco_id}', 'Personal\SaccoController@saccoMemberCreate')->name('personal.sacco.member.create');
Route::get('/sacco/member/store/{sacco_id}', 'Personal\SaccoController@saccoMemberStore')->name('personal.sacco.member.store');
Route::get('/sacco/member/update/{sacco_id}', 'Personal\SaccoController@saccoMemberUpdate')->name('personal.sacco.member.update');
Route::get('/sacco/member/delete/{sacco_id}', 'Personal\SaccoController@saccoMemberDelete')->name('personal.sacco.member.delete');
Route::get('/sacco/loans/{sacco_id}', 'Personal\SaccoController@saccoLoans')->name('personal.sacco.loans');
Route::get('/sacco/loan/show/{sacco_id}', 'Personal\SaccoController@saccoLoanShow')->name('personal.sacco.loan');
Route::get('/sacco/loan/request/{sacco_id}', 'Personal\SaccoController@saccoLoanRequest')->name('personal.sacco.loan');
Route::get('/sacco/loan/approve/{sacco_id}', 'Personal\SaccoController@saccoLoanAccept')->name('personal.sacco.loan');
Route::get('/sacco/loan/reject/{sacco_id}', 'Personal\SaccoController@saccoLoanReject')->name('personal.sacco.loan');
Route::get('/sacco/loan/create/{sacco_id}', 'Personal\SaccoController@saccoLoanCreate')->name('personal.sacco.loan.create');
Route::get('/sacco/loan/store/{sacco_id}', 'Personal\SaccoController@saccoLoanStore')->name('personal.sacco.loan.store');
Route::get('/sacco/loan/update/{sacco_id}', 'Personal\SaccoController@saccoLoanUpdate')->name('personal.sacco.loan.update');
Route::get('/sacco/loan/payment/{sacco_id}', 'Personal\SaccoController@saccoLoanPayment')->name('personal.sacco.loan.payment');
Route::get('/sacco/loan/waiver/{sacco_id}', 'Personal\SaccoController@saccoLoanWaiver')->name('personal.sacco.loan.waiver');
Route::get('/sacco/loan/default/{sacco_id}', 'Personal\SaccoController@saccoLoanDefault')->name('personal.sacco.loan.default');
Route::get('/sacco/loan/delete/{sacco_id}', 'Personal\SaccoController@saccoLoanDelete')->name('personal.sacco.loan.delete');
Route::get('/sacco/reconciliations/{sacco_id}', 'Personal\SaccoController@saccoReconciliations')->name('personal.sacco.reconciliations');
Route::get('/sacco/reconciliation/create/{sacco_id}', 'Personal\SaccoController@saccoReconciliationCreate')->name('personal.sacco.reconciliation.create');
Route::get('/sacco/reconciliation/update/{sacco_id}', 'Personal\SaccoController@saccoReconciliationUpdate')->name('personal.sacco.reconciliation.update');
Route::get('/sacco/reconciliation/delete/{sacco_id}', 'Personal\SaccoController@saccoReconciliationDelete')->name('personal.sacco.reconciliation.delete');
Route::get('/sacco/edit/{sacco_id}', 'Personal\SaccoController@saccoEdit')->name('personal.sacco.edit');
Route::post('/sacco/update/{sacco_id}', 'Personal\SaccoController@saccoUpdate')->name('personal.sacco.update');
Route::get('/sacco/delete/{sacco_id}', 'Personal\SaccoController@saccoDelete')->name('personal.sacco.delete');


// Trends
Route::get('/analysis', 'Personal\TrendController@analysis')->name('personal.analysis');
Route::get('/analysis/breakdown/{analysis_id}', 'Personal\TrendController@analysisBreakdown')->name('personal.analysis.breakdown');

Route::get('/cash/flow', 'Personal\TrendController@cashFlow')->name('personal.cash.flow');
Route::get('/cash/flow/breakdown/{cash_flow_id}', 'Personal\TrendController@cashFlowBreakdown')->name('personal.cash.flow.breakdown');


// Growth
Route::get('/investments', 'Personal\GrowthController@investments')->name('personal.investments');
Route::get('/investment/create', 'Personal\GrowthController@investmentCreate')->name('personal.investment.create');
Route::post('/investment/store', 'Personal\GrowthController@investmentStore')->name('personal.investment.store');
Route::get('/investment/show/{investment_id}', 'Personal\GrowthController@investmentShow')->name('personal.investment.show');
Route::get('/investment/edit/{investment_id}', 'Personal\GrowthController@investmentEdit')->name('personal.investment.edit');
Route::post('/investment/update/{investment_id}', 'Personal\GrowthController@investmentUpdate')->name('personal.investment.update');
Route::get('/investment/invest/{investment_id}', 'Personal\GrowthController@investmentInvest')->name('personal.investment.invest');
Route::get('/investment/withdraw/{investment_id}', 'Personal\GrowthController@investmentWithdraw')->name('personal.investment.withdraw');
Route::get('/investment/close/{investment_id}', 'Personal\GrowthController@investmentClose')->name('personal.investment.close');
Route::get('/investment/delete/{investment_id}', 'Personal\GrowthController@investmentDelete')->name('personal.investment.delete');

Route::get('/goals', 'Personal\GrowthController@goals')->name('personal.goals');
Route::get('/goal/create', 'Personal\GrowthController@goalCreate')->name('personal.goal.create');
Route::post('/goal/store', 'Personal\GrowthController@goalStore')->name('personal.goal.store');
Route::get('/goal/show/{goal_id}', 'Personal\GrowthController@goalShow')->name('personal.goal.show');
Route::get('/goal/edit/{goal_id}', 'Personal\GrowthController@goalEdit')->name('personal.goal.edit');
Route::post('/goal/update/{goal_id}', 'Personal\GrowthController@goalUpdate')->name('personal.goal.update');
Route::get('/goal/deposit/{goal_id}', 'Personal\GrowthController@goalDeposit')->name('personal.goal.deposit');
Route::get('/goal/withdraw/{goal_id}', 'Personal\GrowthController@goalWithdraw')->name('personal.goal.withdraw');
Route::get('/goal/close/{goal_id}', 'Personal\GrowthController@goalClose')->name('personal.goal.close');
Route::get('/goal/delete/{goal_id}', 'Personal\GrowthController@goalDelete')->name('personal.goal.delete');

Route::get('/ways/to/save', 'Personal\GrowthController@waysToSave')->name('personal.ways.to.save');



// Accounting
// accounts
Route::get('/accounts', 'Personal\AccountController@accounts')->name('personal.accounts');
Route::get('/account/create', 'Personal\AccountController@accountCreate')->name('personal.account.create');
Route::post('/account/store', 'Personal\AccountController@accountStore')->name('personal.account.store');
Route::get('/account/show/{account_id}', 'Personal\AccountController@accountShow')->name('personal.account.show');

Route::get('/account/deposit/create/{account_id}', 'Personal\AccountController@accountDepositCreate')->name('personal.account.deposit.create');
Route::get('/account/liability/create/{account_id}', 'Personal\AccountController@accountLiabilityCreate')->name('personal.account.liability.create');
Route::get('/account/loan/create/{account_id}', 'Personal\AccountController@accountLoanCreate')->name('personal.account.loan.create');
Route::get('/account/withdrawal/create/{account_id}', 'Personal\AccountController@accountWithdrawalCreate')->name('personal.account.withdrawal.create');

Route::get('/account/edit/{account_id}', 'Personal\AccountController@accountEdit')->name('personal.account.edit');
Route::post('/account/update/{account_id}', 'Personal\AccountController@accountUpdate')->name('personal.account.update');
Route::get('/account/delete/{account_id}', 'Personal\AccountController@accountDelete')->name('personal.account.delete');
Route::get('/account/restore/{account_id}', 'Personal\AccountController@accountRestore')->name('personal.account.restore');

// deposits
Route::post('/deposit/store', 'Personal\AccountController@depositStore')->name('personal.deposit.store');
Route::get('/deposit/show/{deposit_id}', 'Personal\AccountController@depositShow')->name('personal.deposit.show');

Route::get('/deposit/account/adjustment/create/{deposit_id}', 'Personal\AccountController@depositAccountAdjustmentCreate')->name('personal.deposit.account.adjustment.create');

Route::post('/deposit/update/{deposit_id}', 'Personal\AccountController@depositUpdate')->name('personal.deposit.update');
Route::get('/deposit/delete/{deposit_id}', 'Personal\AccountController@depositDelete')->name('personal.deposit.delete');
Route::get('/deposit/restore/{deposit_id}', 'Personal\AccountController@depositRestore')->name('personal.deposit.restore');

// withdrawals
Route::post('/withdrawal/store', 'Personal\AccountController@withdrawalStore')->name('personal.withdrawal.store');
Route::get('/withdrawal/show/{withdrawal_id}', 'Personal\AccountController@withdrawalShow')->name('personal.withdrawal.show');

Route::get('/withdrawal/account/adjustment/create/{withdrawal_id}', 'Personal\AccountController@withdrawalAccountAdjustmentCreate')->name('personal.withdrawal.account.adjustment.create');

Route::post('/withdrawal/update/{withdrawal_id}', 'Personal\AccountController@withdrawalUpdate')->name('personal.withdrawal.update');
Route::get('/withdrawal/delete/{withdrawal_id}', 'Personal\AccountController@withdrawalDelete')->name('personal.withdrawal.delete');
Route::get('/withdrawal/restore/{withdrawal_id}', 'Personal\AccountController@withdrawalRestore')->name('personal.withdrawal.restore');

// account adjustment
Route::get('/account/adjustment/create/{account_id}', 'Personal\AccountController@accountAdjustmentCreate')->name('personal.account.adjustment.create');
Route::get('/account/adjustment/create/{account_id}', 'Personal\AccountController@accountAdjustmentCreate')->name('personal.account.adjustment.create');
Route::post('/account/adjustment/store', 'Personal\AccountController@accountAdjustmentStore')->name('personal.account.adjustment.store');
Route::get('/account/adjustment/edit/{account_id}', 'Personal\AccountController@accountAdjustmentEdit')->name('personal.account.adjustment.edit');
Route::post('/account/adjustment/update/{account_id}', 'Personal\AccountController@accountAdjustmentUpdate')->name('personal.account.adjustment.update');
Route::get('/account/adjustment/delete/{account_id}', 'Personal\AccountController@accountAdjustmentDelete')->name('personal.account.adjustment.delete');
Route::get('/account/adjustment/restore/{account_id}', 'Personal\AccountController@accountAdjustmentRestore')->name('personal.account.adjustment.restore');


// expenses
Route::get('/expenses', 'Personal\ExpenseController@expenses')->name('personal.expenses');
Route::get('/expense/create', 'Personal\ExpenseController@expenseCreate')->name('personal.expense.create');
Route::post('/expense/store', 'Personal\ExpenseController@expenseStore')->name('personal.expense.store');
Route::get('/expense/show/{expense_id}', 'Personal\ExpenseController@expenseShow')->name('personal.expense.show');
Route::get('/expense/edit/{expense_id}', 'Personal\ExpenseController@expenseEdit')->name('personal.expense.edit');
Route::post('/expense/update/{expense_id}', 'Personal\ExpenseController@expenseUpdate')->name('personal.expense.update');
Route::get('/expense/delete/{expense_id}', 'Personal\ExpenseController@expenseDelete')->name('personal.expense.delete');
Route::get('/expense/restore/{expense_id}', 'Personal\ExpenseController@expenseRestore')->name('personal.expense.restore');
Route::get('/expense/product/delete/{expense_id}', 'Personal\ExpenseController@expenseProductDelete')->name('personal.expense.product.delete');
Route::get('/expense/product/restore/{expense_id}', 'Personal\ExpenseController@expenseProductRestore')->name('personal.expense.product.restore');


// liabilities
Route::get('/liabilities', 'Personal\AccountController@liabilities')->name('personal.liabilities');
Route::get('/liability/create', 'Personal\AccountController@liabilityCreate')->name('personal.liability.create');
Route::post('/liability/store', 'Personal\AccountController@liabilityStore')->name('personal.liability.store');
Route::get('/liability/show/{liability_id}', 'Personal\AccountController@liabilityShow')->name('personal.liability.show');

Route::get('/liability/expense/create/{liability_id}', 'Personal\AccountController@liabilityExpenseCreate')->name('personal.liability.expense.create');

Route::get('/liability/edit/{liability_id}', 'Personal\AccountController@liabilityEdit')->name('personal.liability.edit');
Route::post('/liability/update/{liability_id}', 'Personal\AccountController@liabilityUpdate')->name('personal.liability.update');
Route::get('/liability/delete/{liability_id}', 'Personal\AccountController@liabilityDelete')->name('personal.liability.delete');
Route::get('/liability/restore/{liability_id}', 'Personal\AccountController@liabilityRestore')->name('personal.liability.restore');


// loans
Route::get('/loans', 'Personal\AccountController@loans')->name('personal.loans');
Route::get('/loan/create', 'Personal\AccountController@loanCreate')->name('personal.loan.create');
Route::post('/loan/store', 'Personal\AccountController@loanStore')->name('personal.loan.store');
Route::get('/loan/show/{loan_id}', 'Personal\AccountController@loanShow')->name('personal.loan.show');

Route::get('/loan/payment/create/{loan_id}', 'Personal\AccountController@loanPaymentCreate')->name('personal.loan.payment.create');

Route::get('/loan/edit/{loan_id}', 'Personal\AccountController@loanEdit')->name('personal.loan.edit');
Route::post('/loan/update/{loan_id}', 'Personal\AccountController@loanUpdate')->name('personal.loan.update');
Route::get('/loan/delete/{loan_id}', 'Personal\AccountController@loanDelete')->name('personal.loan.delete');
Route::get('/loan/restore/{loan_id}', 'Personal\AccountController@loanRestore')->name('personal.loan.restore');


// payments
Route::get('/payments', 'Personal\ExpenseController@payments')->name('personal.payments');
Route::get('/payment/create', 'Personal\ExpenseController@paymentCreate')->name('personal.payment.create');
Route::post('/payment/store', 'Personal\ExpenseController@paymentStore')->name('personal.payment.store');
Route::get('/payment/show/{payment_id}', 'Personal\ExpenseController@paymentShow')->name('personal.payment.show');

Route::get('/payment/{payment_id}/refund/create', 'Personal\ExpenseController@refundCreate')->name('personal.payment.refund.create');

Route::get('/payment/delete/{payment_id}', 'Personal\ExpenseController@paymentDelete')->name('personal.payment.delete');
Route::get('/payment/restore/{payment_id}', 'Personal\ExpenseController@paymentRestore')->name('personal.payment.restore');


// refunds
Route::get('/refunds', 'Personal\ExpenseController@refunds')->name('personal.refunds');
Route::post('/refund/store', 'Personal\ExpenseController@refundStore')->name('personal.refund.store');
Route::get('/refund/show/{refund_id}', 'Personal\ExpenseController@refundShow')->name('personal.refund.show');
Route::get('/refund/edit/{refund_id}', 'Personal\ExpenseController@refundEdit')->name('personal.refund.edit');
Route::post('/refund/update/{refund_id}', 'Personal\ExpenseController@refundUpdate')->name('personal.refund.update');
Route::get('/refund/delete/{refund_id}', 'Personal\ExpenseController@refundDelete')->name('personal.refund.delete');
Route::get('/refund/restore/{refund_id}', 'Personal\ExpenseController@refundRestore')->name('personal.refund.restore');


// transactions
Route::get('/transactions', 'Personal\ExpenseController@transactions')->name('personal.transactions');
Route::get('/transaction/create/{expense_id}', 'Personal\ExpenseController@transactionCreate')->name('personal.transaction.create');
Route::post('/transaction/store', 'Personal\ExpenseController@transactionStore')->name('personal.transaction.store');
Route::get('/transaction/edit/{transaction_id}', 'Personal\ExpenseController@transactionEdit')->name('personal.transaction.edit');
Route::post('/transaction/update/{transaction_id}', 'Personal\ExpenseController@transactionUpdate')->name('personal.transaction.update');
Route::get('/transaction/billed/{transaction_id}', 'Personal\ExpenseController@transactionBilled')->name('personal.transaction.billed');
Route::get('/transaction/pending/payment/{transaction_id}', 'Personal\ExpenseController@transactionPendingPayment')->name('personal.transaction.pending.payment');
Route::get('/transaction/delete/{transaction_id}', 'Personal\ExpenseController@transactionDelete')->name('personal.transaction.delete');
Route::get('/transaction/restore/{transaction_id}', 'Personal\ExpenseController@transactionRestore')->name('personal.transaction.restore');


// transfers
Route::get('/transfers', 'Personal\AccountController@transfers')->name('personal.transfers');
Route::get('/transfer/create', 'Personal\AccountController@transferCreate')->name('personal.transfer.create');
Route::post('/transfer/store', 'Personal\AccountController@transferStore')->name('personal.transfer.store');
Route::get('/transfer/show/{transfer_id}', 'Personal\AccountController@transferShow')->name('personal.transfer.show');

Route::get('/transfer/expense/create/{transfer_id}', 'Personal\AccountController@transferExpenseCreate')->name('personal.transfer.expense.create');

Route::get('/transfer/edit/{transfer_id}', 'Personal\AccountController@transferEdit')->name('personal.transfer.edit');
Route::post('/transfer/update/{transfer_id}', 'Personal\AccountController@transferUpdate')->name('personal.transfer.update');
Route::get('/transfer/delete/{transfer_id}', 'Personal\AccountController@transferDelete')->name('personal.transfer.delete');
Route::get('/transfer/restore/{transfer_id}', 'Personal\AccountController@transferRestore')->name('personal.transfer.restore');


// Frequencies
Route::get('/frequencies', 'Personal\SettingController@frequencies')->name('personal.frequencies');
Route::get('/frequency/create', 'Personal\SettingController@frequencyCreate')->name('personal.frequency.create');
Route::post('/frequency/store', 'Personal\SettingController@frequencyStore')->name('personal.frequency.store');
Route::get('/frequency/show/{contact_type_id}', 'Personal\SettingController@frequencyShow')->name('personal.frequency.show');
Route::post('/frequency/update/{contact_type_id}', 'Personal\SettingController@frequencyUpdate')->name('personal.frequency.update');
Route::get('/frequency/delete/{contact_type_id}', 'Personal\SettingController@frequencyDelete')->name('personal.frequency.delete');
Route::get('/frequency/restore/{contact_type_id}', 'Personal\SettingController@frequencyRestore')->name('personal.frequency.restore');


// Titles
Route::get('/titles', 'Personal\SettingController@titles')->name('personal.titles');
Route::get('/title/create', 'Personal\SettingController@titleCreate')->name('personal.title.create');
Route::post('/title/store', 'Personal\SettingController@titleStore')->name('personal.title.store');
Route::get('/title/show/{title_id}', 'Personal\SettingController@titleShow')->name('personal.title.show');
Route::post('/title/update/{title_id}', 'Personal\SettingController@titleUpdate')->name('personal.title.update');
Route::get('/title/delete/{title_id}', 'Personal\SettingController@titleDelete')->name('personal.title.delete');
Route::get('/title/restore/{title_id}', 'Personal\SettingController@titleRestore')->name('personal.title.restore');

// Expense accounts
Route::get('/expense/accounts', 'Personal\SettingController@expenseAccounts')->name('personal.expense.accounts');
Route::get('/expense/account/create', 'Personal\SettingController@expenseAccountCreate')->name('personal.expense.account.create');
Route::post('/expense/account/store', 'Personal\SettingController@expenseAccountStore')->name('personal.expense.account.store');
Route::get('/expense/account/show/{title_id}', 'Personal\SettingController@expenseAccountShow')->name('personal.expense.account.show');
Route::post('/expense/account/update/{title_id}', 'Personal\SettingController@expenseAccountUpdate')->name('personal.expense.account.update');
Route::get('/expense/account/delete/{title_id}', 'Personal\SettingController@expenseAccountDelete')->name('personal.expense.account.delete');
Route::get('/expense/account/restore/{title_id}', 'Personal\SettingController@expenseAccountRestore')->name('personal.expense.account.restore');


// Settings
Route::get('/commitments', 'Personal\SettingController@commitments')->name('personal.commitments');
Route::get('/commitment/create', 'Personal\SettingController@commitmentCreate')->name('personal.commitment.create');
Route::get('/commitment/store', 'Personal\SettingController@commitmentStore')->name('personal.commitment.store');
Route::get('/commitment/show/{commitment_id}', 'Personal\SettingController@commitmentShow')->name('personal.commitment.show');
Route::get('/commitment/edit/{commitment_id}', 'Personal\SettingController@commitmentEdit')->name('personal.commitment.edit');
Route::get('/commitment/update/{commitment_id}', 'Personal\SettingController@commitmentUpdate')->name('personal.commitment.update');
Route::get('/commitment/delete/{commitment_id}', 'Personal\SettingController@commitmentDelete')->name('personal.commitment.delete');




// Chamas
Route::get('/chamas', 'Personal\ChamaController@chamas')->name('personal.chamas');
Route::get('/chama/create', 'Personal\ChamaController@chamaCreate')->name('personal.chama.create');
Route::post('/chama/store', 'Personal\ChamaController@chamaStore')->name('personal.chama.store');
Route::get('/chama/show/{chama_id}', 'Personal\ChamaController@chamaShow')->name('personal.chama.show');
Route::post('/chama/update/{chama_id}', 'Personal\ChamaController@chamaUpdate')->name('personal.chama.update');
Route::get('/chama/delete/{chama_id}', 'Personal\ChamaController@chamaDelete')->name('personal.chama.delete');
Route::get('/chama/restore/{chama_id}', 'Personal\ChamaController@chamaRestore')->name('personal.chama.restore');

// accounts
Route::get('/chama/{chama_id}/accounts', 'Personal\ChamaController@chamaAccounts')->name('personal.chama.accounts');
Route::get('chama/{chama_id}/account/create', 'Personal\ChamaController@chamaAccountCreate')->name('personal.chama.account.create');
Route::post('/chama/{chama_id}/account/store', 'Personal\ChamaController@chamaAccountStore')->name('personal.chama.account.store');
Route::get('/chama/{chama_id}/account/show/{account_id}', 'Personal\ChamaController@chamaAccountShow')->name('personal.chama.account.show');

Route::get('/chama/{chama_id}/account/deposit/create/{account_id}', 'Personal\ChamaController@chamaAccountDepositCreate')->name('personal.chama.account.deposit.create');
Route::get('/chama/{chama_id}/account/liability/create/{account_id}', 'Personal\ChamaController@chamaAccountLiabilityCreate')->name('personal.chama.account.liability.create');
Route::get('/chama/{chama_id}/account/loan/create/{account_id}', 'Personal\ChamaController@chamaAccountLoanCreate')->name('personal.chama.account.loan.create');
Route::get('/chama/{chama_id}/account/withdrawal/create/{account_id}', 'Personal\ChamaController@chamaAccountWithdrawalCreate')->name('personal.chama.account.withdrawal.create');

Route::get('/chama/{chama_id}/account/edit/{account_id}', 'Personal\ChamaController@chamaAccountEdit')->name('personal.chama.account.edit');
Route::post('/chama/{chama_id}/account/update/{account_id}', 'Personal\ChamaController@chamaAccountUpdate')->name('personal.chama.account.update');
Route::get('/chama/{chama_id}/account/delete/{account_id}', 'Personal\ChamaController@chamaAccountDelete')->name('personal.chama.account.delete');
Route::get('/chama/{chama_id}/account/restore/{account_id}', 'Personal\ChamaController@chamaAccountRestore')->name('personal.chama.account.restore');

// deposits
Route::post('/chama/{chama_id}/deposit/store', 'Personal\ChamaController@chamaDepositStore')->name('personal.chama.deposit.store');
Route::get('/chama/{chama_id}/deposit/show/{deposit_id}', 'Personal\ChamaController@chamaDepositShow')->name('personal.chama.deposit.show');

Route::get('/chama/{chama_id}/deposit/account/adjustment/create/{deposit_id}', 'Personal\ChamaController@chamaDepositAccountAdjustmentCreate')->name('personal.chama.deposit.account.adjustment.create');

Route::post('/chama/{chama_id}/deposit/update/{deposit_id}', 'Personal\ChamaController@chamaDepositUpdate')->name('personal.chama.deposit.update');
Route::get('/chama/{chama_id}/deposit/delete/{deposit_id}', 'Personal\ChamaController@chamaDepositDelete')->name('personal.chama.deposit.delete');
Route::get('/chama/{chama_id}/deposit/restore/{deposit_id}', 'Personal\ChamaController@chamaDepositRestore')->name('personal.chama.deposit.restore');

// withdrawals
Route::post('/chama/{chama_id}/withdrawal/store', 'Personal\ChamaController@chamaWithdrawalStore')->name('personal.chama.withdrawal.store');
Route::get('/chama/{chama_id}/withdrawal/show/{withdrawal_id}', 'Personal\ChamaController@chamaWithdrawalShow')->name('personal.chama.withdrawal.show');

Route::get('/chama/{chama_id}/withdrawal/account/adjustment/create/{withdrawal_id}', 'Personal\ChamaController@chamaWithdrawalAccountAdjustmentCreate')->name('personal.chama.withdrawal.account.adjustment.create');

Route::post('/chama/{chama_id}/withdrawal/update/{withdrawal_id}', 'Personal\ChamaController@chamaWithdrawalUpdate')->name('personal.chama.withdrawal.update');
Route::get('/chama/{chama_id}/withdrawal/delete/{withdrawal_id}', 'Personal\ChamaController@chamaWithdrawalDelete')->name('personal.chama.withdrawal.delete');
Route::get('/chama/{chama_id}/withdrawal/restore/{withdrawal_id}', 'Personal\ChamaController@chamaWithdrawalRestore')->name('personal.chama.withdrawal.restore');

// account adjustment
Route::get('/chama/{chama_id}/account/adjustment/create/{account_id}', 'Personal\ChamaController@chamaAccountAdjustmentCreate')->name('personal.chama.account.adjustment.create');
Route::get('/chama/{chama_id}/account/adjustment/create/{account_id}', 'Personal\ChamaController@chamaAccountAdjustmentCreate')->name('personal.chama.account.adjustment.create');
Route::post('/chama/{chama_id}/account/adjustment/store', 'Personal\ChamaController@chamaAccountAdjustmentStore')->name('personal.chama.account.adjustment.store');
Route::get('/chama/{chama_id}/account/adjustment/edit/{account_id}', 'Personal\ChamaController@chamaAccountAdjustmentEdit')->name('personal.chama.account.adjustment.edit');
Route::post('/chama/{chama_id}/account/adjustment/update/{account_id}', 'Personal\ChamaController@chamaAccountAdjustmentUpdate')->name('personal.chama.account.adjustment.update');
Route::get('/chama/{chama_id}/account/adjustment/delete/{account_id}', 'Personal\ChamaController@chamaAccountAdjustmentDelete')->name('personal.chama.account.adjustment.delete');
Route::get('/chama/{chama_id}/account/adjustment/restore/{account_id}', 'Personal\ChamaController@chamaAccountAdjustmentRestore')->name('personal.chama.account.adjustment.restore');

// liabilities
Route::get('/chama/{chama_id}/liabilities', 'Personal\ChamaController@chamaLiabilities')->name('personal.chama.liabilities');
Route::get('/chama/{chama_id}/liability/create', 'Personal\ChamaController@chamaLiabilityCreate')->name('personal.chama.liability.create');
Route::post('/chama/{chama_id}/liability/store', 'Personal\ChamaController@chamaLiabilityStore')->name('personal.chama.liability.store');
Route::get('/chama/{chama_id}/liability/show/{liability_id}', 'Personal\ChamaController@chamaLiabilityShow')->name('personal.chama.liability.show');

Route::get('/chama/{chama_id}/liability/expense/create/{liability_id}', 'Personal\ChamaController@chamaLiabilityExpenseCreate')->name('personal.chama.liability.expense.create');

Route::get('/chama/{chama_id}/liability/edit/{liability_id}', 'Personal\ChamaController@chamaLiabilityEdit')->name('personal.chama.liability.edit');
Route::post('/chama/{chama_id}/liability/update/{liability_id}', 'Personal\ChamaController@chamaLiabilityUpdate')->name('personal.chama.liability.update');
Route::get('/chama/{chama_id}/liability/delete/{liability_id}', 'Personal\ChamaController@chamaLiabilityDelete')->name('personal.chama.liability.delete');
Route::get('/chama/{chama_id}/liability/restore/{liability_id}', 'Personal\ChamaController@chamaLiabilityRestore')->name('personal.chama.liability.restore');


// loans
Route::get('/chama/{chama_id}/loans', 'Personal\ChamaController@chamaLoans')->name('personal.chama.loans');
Route::get('/chama/{chama_id}/loan/create', 'Personal\ChamaController@chamaLoanCreate')->name('personal.chama.loan.create');
Route::post('/chama/{chama_id}/loan/store', 'Personal\ChamaController@chamaLoanStore')->name('personal.chama.loan.store');
Route::get('/chama/{chama_id}/loan/show/{loan_id}', 'Personal\ChamaController@chamaLoanShow')->name('personal.chama.loan.show');

Route::get('/chama/{chama_id}/loan/payment/create/{loan_id}', 'Personal\ChamaController@chamaLoanPaymentCreate')->name('personal.chama.loan.payment.create');

Route::get('/chama/{chama_id}/loan/edit/{loan_id}', 'Personal\ChamaController@chamaLoanEdit')->name('personal.chama.loan.edit');
Route::post('/chama/{chama_id}/loan/update/{loan_id}', 'Personal\ChamaController@chamaLoanUpdate')->name('personal.chama.loan.update');
Route::get('/chama/{chama_id}/loan/delete/{loan_id}', 'Personal\ChamaController@chamaLoanDelete')->name('personal.chama.loan.delete');
Route::get('/chama/{chama_id}/loan/restore/{loan_id}', 'Personal\ChamaController@chamaLoanRestore')->name('personal.chama.loan.restore');

// transfers
Route::get('/chama/{chama_id}/transfers', 'Personal\ChamaController@chamaTransfers')->name('personal.chama.transfers');
Route::get('/chama/{chama_id}/transfer/create', 'Personal\ChamaController@chamaTransferCreate')->name('personal.chama.transfer.create');
Route::post('/chama/{chama_id}/transfer/store', 'Personal\ChamaController@chamaTransferStore')->name('personal.chama.transfer.store');
Route::get('/chama/{chama_id}/transfer/show/{transfer_id}', 'Personal\ChamaController@chamaTransferShow')->name('personal.chama.transfer.show');

Route::get('/chama/{chama_id}/transfer/expense/create/{transfer_id}', 'Personal\ChamaController@chamaTransferExpenseCreate')->name('personal.chama.transfer.expense.create');

Route::get('/chama/{chama_id}/transfer/edit/{transfer_id}', 'Personal\ChamaController@chamaTransferEdit')->name('personal.chama.transfer.edit');
Route::post('/chama/{chama_id}/transfer/update/{transfer_id}', 'Personal\ChamaController@chamaTransferUpdate')->name('personal.chama.transfer.update');
Route::get('/chama/{chama_id}/transfer/delete/{transfer_id}', 'Personal\ChamaController@chamaTransferDelete')->name('personal.chama.transfer.delete');
Route::get('/chama/{chama_id}/transfer/restore/{transfer_id}', 'Personal\ChamaController@chamaTransferRestore')->name('personal.chama.transfer.restore');


// chama members
Route::get('/chama/{chama_id}/members', 'Personal\ChamaController@chamaMembers')->name('personal.chama.members');
Route::get('/chama/{chama_id}/create', 'Personal\ChamaController@chamaMemberCreate')->name('personal.chama.member.create');
Route::post('/chama/{chama_id}/store', 'Personal\ChamaController@chamaMemberStore')->name('personal.chama.member.store');
Route::get('/chama/{chama_id}/member/show/{chama_id}', 'Personal\ChamaController@chamaMemberShow')->name('personal.chama.member.show');
Route::post('/chama/{chama_id}/update/{chama_id}', 'Personal\ChamaController@chamaMemberUpdate')->name('personal.chama.member.update');
Route::get('/chama/{chama_id}/delete/{chama_id}', 'Personal\ChamaController@chamaMemberDelete')->name('personal.chama.member.delete');
Route::get('/chama/{chama_id}/restore/{chama_id}', 'Personal\ChamaController@chamaMemberRestore')->name('personal.chama.member.restore');




Route::get('/chama/{chama_id}/meetings', 'Personal\ChamaController@chamaMeetings')->name('personal.chama.meetings');
Route::get('/chama/{chama_id}/merry/go/round', 'Personal\ChamaController@chamaMerryGoRound')->name('personal.chama.merry.go.round');
Route::get('/chama/{chama_id}/penalties', 'Personal\ChamaController@chamaPenalties')->name('personal.chama.penalties');
Route::get('/chama/{chama_id}/shares', 'Personal\ChamaController@chamaShares')->name('personal.chama.shares');
Route::get('/chama/{chama_id}/welfare', 'Personal\ChamaController@chamaWelfare')->name('personal.chama.welfare');
