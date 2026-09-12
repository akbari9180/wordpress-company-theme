const loadMoreButton=document.querySelector('#load-more');
let page=1;
loadMoreButton.addEventListener('click',function(){
    page++;
    loadMoreButton.disabled =true;//برای اینه که چند درخواست پشت سرهم ارسال نشه
    const formData=new FormData();
    formData.append('action','load_more_posts');
    formData.append('page',page);
    formData.append('nonce', ajaxData.nonce);
    fetch('/sadafshop/wp-admin/admin-ajax.php',{
        method:'POST',
        body:formData
    })
    .then(response=>response.json())
    .then(data=>{
    const postsContainer = document.querySelector('#posts-container');
    postsContainer.insertAdjacentHTML('beforeend', data.data.html);
    if (data.data.no_more_posts) {

    loadMoreButton.style.display = 'none';

}
loadMoreButton.disabled = false;
 });
    
})