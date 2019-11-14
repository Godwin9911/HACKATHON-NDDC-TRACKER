displayUserData = () => {
  const userInfo = JSON.parse(localStorage.getItem("nddc-tracker-user"));
  console.log(userInfo);
  const { user, image_link } = userInfo;
  console.log(user);
  let {
    name,
    city,
    user_mode,
    image,
    bio,
    email,
    state,
    gender,
    user_type
  } = user;
  console.log(
    name,
    city,
    user_mode,
    image,
    bio,
    email,
    state,
    gender,
    user_type
  );
  if (name == null) {
    name = "Hello Member";
  }
  if (city == null) {
    city = "Location: Not set yet";
  }
  if ((bio = null)) {
    bio = "Bio not set. Set a bio now";
  }
  const dataConName = document.querySelector("#data-con-name");
  const dataConCity = document.querySelector("#data-con-city");
  const dataUserImage = document.querySelector("#user-image");
  const navUserImage = document.querySelector("#nav-user-image");
  const navName = document.querySelector("#nav-name");
  const nameListed = document.querySelector("#name-listed");
  const cityListed = document.querySelector("#city-listed");
  const bioListed = document.querySelector("#bio-listed");
  const emailListed = document.querySelector("#email-listed");
  const stateListed = document.querySelector("#state-listed");
  const genderListed = document.querySelector("#gender-listed");
  const userTypeListed = document.querySelector("#user-type-listed");
  const imageListed = document.querySelector("#image-listed");

  dataConName.innerHTML = name;
  dataConCity.innerHTML = city;
  nameListed.innerHTML = name;
  cityListed.innerHTML = city;
  bioListed.innerHTML = bio;
  emailListed.innerHTML = email;
  stateListed.innerHTML = state;
  genderListed.innerHTML = gender;
  userTypeListed.innerHTML = user_type;

dataConName.innerHTML = name;
dataConCity.innerHTML = city;

  console.log(user_mode);
  if (user_mode == "nddc-tracker") {
    dataUserImage.src = `${image_link}${image}`;
    navUserImage.src = `${image_link}${image}`;
    imageListed.src = `${image_link}${image}`;
  }
};
displayUserData();
