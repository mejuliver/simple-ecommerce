@extends('app')

@section('header_part')
	<style>
		body{
			background: var(--secondary_color);
		}
	</style>
@endsection

@section('content')
<section class="pt100 pb100">
	<div class="container">
		<div class="row mt44 mb44 d-flex align-items-center">
			<div class="col-7 d-none d-md-flex">
				<h1 class="text-white">Empowering Your Online Shopping Adventure</h1>
			</div>
			<div class="col-5">	
				<div class="box bg-white">
					<form action="" x-data="data()" @submit.prevent="submit" class="row">
						<div class="col-12">
							<h3>FORGOT PASSWORD</h3>
							<div class="input-box">
								<input type="email" x-model="data.email" placeholder="email" name="email" class="form-control" :disabled="data.is_saving">
							</div>
							<div class="mt24 mb24">	
								<button class="btn-block btn btn-primary" :disabled="data.is_saving" x-text="data.is_saving ? 'SUBMITTING...' : 'SUBMIT' "></button>
							</div>
						</div>
						<div class="col-12">
							<div class="row">
								<div class="col-12 col-md-6 d-flex mb8">
									<p class="mb00">Already have an account? <a href="{{ url('/login') }}">Login</a></p>
								</div>
								<div class="col-12 col-md-6 d-flex mb8">
									<p class="mb00">Don't have an account? <a href="{{ url('/register') }}">Register</a></p>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	function data(){
		return {
			data: {
				email: '',
				password: '',
				is_saving: false,
				errors: []
			},
			SwalAlert(v,i){
				if( !i ) return;

				Swal.fire({
			        title: 'Error!',
			        text: v.join(', '),
			        icon: i,
			    });
			},
			validateForm(){
				if( !this.$store.utility.isValidEmail(this.data.email) ){
					this.data.errors.push('Invalid email');
				}
			},
			submit(){
				this.data.errors = [];
				this.data.is_saving = true;

				this.validateForm();

				if( this.data.errors.length > 0  ){
					this.SwalAlert(this.data.errors,'error');
					return;
				}

				axios.post(
				app_utility.base_url+'/forgot-password',
				{
					email: this.data.email,
				})
				.then(res=>{
					this.SwalAlert(['Check your email, a password reset link has been sent!'],'success');
				})
				.catch(err=>{
					console.log(err);
					this.data.errors = Object.values(err.response.data.errors);
			        this.data.is_saving = false;
			        this.SwalAlert(this.data.errors,'error');
				});
			}
		}
	}

</script>

@endsection

@section('footer_part')


@endsection