import './bootstrap';

({
	data: function(){
		return {
			input_box: document.querySelectorAll('.input-box')
		}
	},
	init: function(){
		let _this = this;

		this.data().input_box.forEach(item=>{
			if( item.querySelector('input').getAttribute('placeholder') && item.querySelector('input').getAttribute('placeholder') != '' ){
				let el = document.createElement('label');
				el.textContent = item.querySelector('input').getAttribute('placeholder');
				item.appendChild(el);
				item.querySelector('input').placeholder = '';
			}

			if( item.querySelector('input').value != '' ){
				item.classList.add('focus');
			}

			item.querySelector('input').addEventListener('focus',function(){
				this.closest('.input-box').classList.add('focus');
			});

			item.querySelector('input').addEventListener('focusout',function(){
				if( this.value == '' ){
					this.closest('.input-box').classList.remove('focus');
				}else{
					this.closest('.input-box').classList.add('focus');
				}
			});
		});
	}

})
.init()