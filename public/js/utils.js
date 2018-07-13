function updateAvatarPreview(input, imageHolder)
{
    imageHolder.src = URL.createObjectURL(input.files[0]);
}
