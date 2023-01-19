<h1>{{ $company->company_name }}</h1>
<p>{{ $company->company_email }}</p>
<p>{{ $company->company_website }}</p>

<br>
<br>
<img src="{{ asset('storage/'. $company->company) }}" alt="">