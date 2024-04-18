<div class="container-fluid pl-0 h-100">
  <div class="row h-100">
    <div class="col-md-8 pr-0 mh-100">
      <img id="photo" src="" style="object-fit: cover;" class="w-100 h-100 mh-100">
    </div>
    <div class="col-md-4 d-flex flex-column align-items-center mt-5">
      <img src="<?php echo FRONTEND_ASSET . "images/logo.png" ?>" class="w-75 mb-5 mb-3">
      <div class="w-75">
        <h3 class="mb-2">Login</h3>
        <form action="" method="post">
          <div class="form-group">
            <input type="text" class="form-control" id="username" placeholder="someone@example.com" name="username">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
          </div>
          <input type="hidden" name="csrf_token" value="<?php echo Token::generate('login_form'); ?>">
          <input type="submit" value="Log In" class="btn btn-primary">
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  const API_KEY = 'LLZgoqkPXHEgRkD5k5fiAI5ZH1HITjFJ9ttNMyMdjXZJz2Ax4dIqWRcF';
  const searchQuery = 'nature'; // Example search query, you can change it to whatever you like
  const photoElement = document.getElementById('photo');

  fetch(`https://api.pexels.com/v1/search?query=${searchQuery}&per_page=20`, {
      headers: {
        Authorization: API_KEY
      }
    })
    .then(response => response.json())
    .then(data => {
      const totalPhotos = data.photos.length;
      const randomIndex = Math.floor(Math.random() * totalPhotos);
      const randomPhoto = data.photos[randomIndex];

      photoElement.src = randomPhoto.src.original; // You can change the size according to your preference (small, medium, large, original)
      photoElement.alt = randomPhoto.url; // Optionally set alt text to the photo's URL
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });
</script>