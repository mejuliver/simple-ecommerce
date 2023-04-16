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
							<h3>RESET PASSWORD</h3>
							<div class="input-box">
								<span class="password-eye" @click="data.show_password = !data.show_password ? true : false" x-text="data.show_password ? 'hide' : 'show'"></span>
								<input :type="data.show_password ? 'text' : 'password'" x-model="data.password" placeholder="password" name="password" class="form-control" :disabled="data.is_saving">
							</div>
							<div class="input-box">
								<span class="password-eye" @click="data.show_password = !data.show_password ? true : false" x-text="data.show_password ? 'hide' : 'show'" :disabled="data.is_saving"></span>
								<input :type="data.show_password ? 'text' : 'password'" x-model="data.confirm_password" placeholder="confirm password" name="confirm_password" class="form-control">
							</div>
							<div class="mt24 mb24">	
								<button class="btn-block btn btn-primary" :disabled="data.is_saving" x-text="data.is_saving ? 'SUBMITTING...' : 'RESET PASSWORD'"></button>
							</div>
						</div>
						<div class="col-12">
							<div class="row">
								<div class="col-12 col-md-6 d-flex mb8">
									<p class="mb00">Already have an account? <a href="{{ url('/login') }}">Login</a></p>
								</div>
								<div class="col-12 col-md-6 d-flex mb8">
									<p class="mb00">Lost password? <a href="{{ url('/forgot-password') }}">Recover</a></p>
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
				token: "{{ $token }}",
        		email: "{{ $email }}",
				password: '',
				confirm_password: '',
				is_saving: false,
				errors: [],
				show_password: false
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

				if( this.$store.utility.isEmpty(this.data.password) ){
					this.data.errors.push('Password is required');
				}

				if( this.$store.utility.isEmpty(this.data.confirm_password) ){
					this.data.errors.push('Confirm password is required');
				}

				if( this.data.confirm_password != this.data.password ){
					this.data.errors.push('Confirm password is not same with password');
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
				app_utility.base_url+'/reset-password',
				{
					token: this.data.token,					
					email: this.data.email,
					password: this.data.password,
					password_confirmation: this.data.confirm_password
				})
				.then(res=>{
					if( app_utility.redirect_url && app_utility.redirect_url != '' ){
						location.replace(app_utility.redirect_url);
					}else{
						location.replace(app_utility.base_url+'/login');
					}
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