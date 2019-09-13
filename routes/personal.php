<?php


Route::get('/home', 'HomeController@index')->name('home');


// Dashboard
Route::get('/dashboard', 'Personal\DashboardController@dashboard')->name('personal.dashboard');


// Profile
Route::get('/profile', 'Personal\ProfileController@profile')->name('personal.profile');
Route::get('/profile/update/{profile_id}', 'Personal\ProfileController@profileUpdate')->name('personal.profile.update');


//Calendar
Route::get('/calendar', 'Personal\CalendarController@calendar')->name('personal.calendar');
Route::post('/calendar/update/{calendar_id}', 'Personal\CalendarController@calendarStore')->name('personal.calendar.store');


// To Do
Route::get('/to/dos', 'Personal\ToDoController@toDos')->name('personal.to.dos');
Route::post('/to/do/store', 'Personal\ToDoController@toDoStore')->name('personal.to.do.store');


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


// Expenses
Route::get('/expenses', 'Personal\ExpenseController@expenses')->name('personal.expenses');
Route::get('/expense/create', 'Personal\ExpenseController@expenseCreate')->name('personal.expense.create');
Route::post('/expense/store', 'Personal\ExpenseController@expenseStore')->name('personal.expense.store');
Route::get('/expense/show/{expense_id}', 'Personal\ExpenseController@expenseShow')->name('personal.expense.show');
Route::get('/expense/edit/{expense_id}', 'Personal\ExpenseController@expenseEdit')->name('personal.expense.edit');
Route::post('/expense/update/{expense_id}', 'Personal\ExpenseController@expenseUpdate')->name('personal.expense.update');
Route::get('/expense/delete/{expense_id}', 'Personal\ExpenseController@expenseDelete')->name('personal.expense.delete');

Route::get('/bills', 'Personal\ExpenseController@bills')->name('personal.bills');
Route::get('/bill/create', 'Personal\ExpenseController@billCreate')->name('personal.bill.create');
Route::post('/bill/store', 'Personal\ExpenseController@billStore')->name('personal.bill.store');
Route::get('/bill/show/{bill_id}', 'Personal\ExpenseController@billShow')->name('personal.bill.show');
Route::get('/bill/edit/{bill_id}', 'Personal\ExpenseController@billEdit')->name('personal.bill.edit');
Route::post('/bill/update/{bill_id}', 'Personal\ExpenseController@billUpdate')->name('personal.bill.update');
Route::get('/bill/delete/{bill_id}', 'Personal\ExpenseController@billDelete')->name('personal.bill.delete');


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


// Accounts
Route::get('/accounts', 'Personal\AccountsController@accounts')->name('personal.accounts');
Route::get('/account/create', 'Personal\AccountsController@accountCreate')->name('personal.account.create');
Route::post('/account/store', 'Personal\AccountsController@accountStore')->name('personal.account.store');
Route::get('/account/show/{account_id}', 'Personal\AccountsController@accountShow')->name('personal.account.show');
Route::get('/account/edit/{account_id}', 'Personal\AccountsController@accountEdit')->name('personal.account.edit');
Route::get('/account/update/{account_id}', 'Personal\AccountsController@accountUpdate')->name('personal.account.update');
Route::get('/account/deposit/{account_id}', 'Personal\AccountsController@accountDeposit')->name('personal.account.deposit');
Route::get('/account/withdraw/{account_id}', 'Personal\AccountsController@accountWithdraw')->name('personal.account.withdraw');
Route::get('/account/close/{account_id}', 'Personal\AccountsController@accountClose')->name('personal.account.close');
Route::get('/account/delete/{account_id}', 'Personal\AccountsController@accountDelete')->name('personal.account.delete');


// Settings
Route::get('/family', 'Personal\SettingController@family')->name('personal.family');
Route::get('/family/create', 'Personal\SettingController@familyCreate')->name('personal.family.create');
Route::get('/family/store', 'Personal\SettingController@familyStore')->name('personal.family.store');
Route::get('/family/member/show/{family_id}', 'Personal\SettingController@familyMemberShow')->name('personal.family.member.show');
Route::get('/family/member/edit/{family_id}', 'Personal\SettingController@familyMemberEdit')->name('personal.family.member.edit');
Route::get('/family/member/update/{family_id}', 'Personal\SettingController@familyMemberUpdate')->name('personal.family.member.update');
Route::get('/family/member/delete/{family_id}', 'Personal\SettingController@familyMemberDelete')->name('personal.family.member.delete');

Route::get('/commitments', 'Personal\SettingController@commitments')->name('personal.commitments');
Route::get('/commitment/create', 'Personal\SettingController@commitmentCreate')->name('personal.commitment.create');
Route::get('/commitment/store', 'Personal\SettingController@commitmentStore')->name('personal.commitment.store');
Route::get('/commitment/show', 'Personal\SettingController@commitmentShow')->name('personal.commitment.show');
Route::get('/commitment/edit', 'Personal\SettingController@commitmentEdit')->name('personal.commitment.edit');
Route::get('/commitment/update', 'Personal\SettingController@commitmentUpdate')->name('personal.commitment.update');
Route::get('/commitment/delete', 'Personal\SettingController@commitmentDelete')->name('personal.commitment.delete');
