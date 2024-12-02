// mobile menu
const burgerIcon = document.querySelector('#burger');
const navbarMenu = document.querySelector('#nav-links');

burgerIcon.addEventListener('click', () => {
    navbarMenu.classList.toggle('is-active');
})
// scroll position
window.addEventListener('scroll', function() {
    const scrollPosition = window.scrollY;
    const scrollInput = document.querySelector('.scroll-input');
    
    scrollInput.value = scrollPosition;
})

// SIGN UP MODAL
function createModal(condition) { 
    const newModal = document.createElement("div");
    newModal.classList.add("modal");
    const newModalBackground = document.createElement("div");
    const newModalContent = document.createElement("div");
    newModalBackground.classList.add("modal-background");
    newModalBackground.id = "modalBackground"
    newModalContent.classList.add("modal-content", "card", "has-background-white", "p-5");
    newModal.appendChild(newModalBackground);
    switch(condition) {
        case 'sign-in': 
            newModalContent.innerHTML = `
            <form method="post">
                <h1 class="title is-3 has-text-centered">Sign In</h1>
                <label class="label">Username</label>
                <input type="text" class="input" name="sign-in-username" placeholder="Username" required>
                <br /><br />
                <label for="" class="label">Password</label>
                <input type="password" class="input" name="sign-in-pwd" placeholder="Password" required><br><br>
                <button type="submit" class="button" name="sign-in-submit">Submit</button><br>
            </form>
            <br /><br />
            <button
            class="button is-rounded is-primary is-fullwidth"
            id="createAccountButton" onclick="createModal('sign-up')"
            >
            Create Account
            </button>
            <br /><br />
            <p class="is-size-7 has-text-weight-normal has-text-centered">
            This website is for showcase purposes only.<br />
            Any input or potential customer information or PII
            <strong>is not</strong> submitted, stored or sold.
            </p>
            `
        break;
        case 'sign-up': 
            newModalContent.innerHTML = `
            <form method="post">
                <h1 class="title is-3 has-text-centered">Create Account</h1>
                <label class="label">Username</label>
                <input type="text" class="input" name="sign-up-username" placeholder="Username" required>
                <br /><br />
                <label for="" class="label">Password</label>
                <input type="password" class="input" name="sign-up-pwd" placeholder="Must have at least 8+ mixed case characters, a number and special character" required><br><br>
                <button type="submit" class="button" name="sign-up-submit">Submit</button>
            </form>
            <br /><br /><br />
            <p class="is-size-7 has-text-weight-normal has-text-centered">
                This website is for showcase purposes <strong>only</strong>.<br />
                Any input or potential customer information or PII
                <strong>is not</strong> submitted, stored or sold.
            </p>
            `
        break;
        case 'edit':
            newModalContent.innerHTML = `
            <form method="post">
                <h1 class="title is-3 has-text-centered">Edit Account</h1>
                <h2 class="title is-size-4 ">Old</h2>
                <label class="label">Original Username</label>
                <input type="text" class="input" name="account-edit-original-username" placeholder="Original Username" required>
                <br><br />
                <label for="" class="label">Original Password</label>
                <input type="password" class="input" name="account-edit-original-pwd" placeholder="Original Password" required>
                <br><br>
                <h2 class="title is-size-4">New</h2>
                <label class="label">New Username</label>
                <input type="text" class="input" name="account-edit-new-username" placeholder="New Username" required><br><br>
                <label class="label">New Password</label>
                <input type="password" class="input" name="account-edit-new-pwd" placeholder="New Password" required><br><br>
                <button type="submit" class="button" name="account-edit-submit">Submit</button>
            </form>
            <br /><br /><br />
            <p class="is-size-7 has-text-weight-normal has-text-centered">
                This website is for showcase purposes <strong>only</strong>.<br />
                Any input or potential customer information or PII
                <strong>is not</strong> submitted, stored or sold.
            </p>
            `
        break;
        case 'delete':
            newModalContent.innerHTML = `
            <form method="post">
                <h1 class="title is-3 has-text-centered">Delete Account</h1>
                <label class="label">Username</label>
                <input type="text" class="input" name="account-delete-username" placeholder="Username" required>
                <br /><br />
                <label for="" class="label">Password</label>
                <input type="password" class="input" name="account-delete-pwd" placeholder="Password" required
                ><br><br>
                <button type="submit" class="button is-danger" name="account-delete-submit">Submit</button>
            </form>
            <br /><br /><br />
            <p class="is-size-7 has-text-weight-normal has-text-centered">
                This website is for showcase purposes <strong>only</strong>.<br />
                Any input or potential customer information or PII
                <strong>is not</strong> submitted, stored or sold.
            </p>
            `
        break;
    }
    
    newModal.appendChild(newModalContent);
    document.body.appendChild(newModal);

    newModal.classList.toggle('is-active');
    const modalBackground = document.getElementById('modalBackground');
    modalBackground.addEventListener('click', function() {
        newModal.classList.toggle('is-active');
        deleteSignUp();
    })
    function deleteSignUp() {
        document.body.removeChild(newModal);
    }
}
function showCheckout() {
    const checkout = document.querySelector('.checkout');
    checkout.style.visibility = "visible";
    const modalBackground = document.querySelector('#checkoutBackground');
    modalBackground.addEventListener('click', function() {
        checkout.style.visibility = "hidden";
    })
}


function productPage(product) {
    localStorage.removeItem("selectedProduct");
    localStorage.setItem("selectedProduct", product);
    window.location.href = "product.php";
}
function loadProductPage() {
    let product = localStorage.getItem("selectedProduct");
    const productPageTitle = document.getElementById("productPageTitle");
    const pageTitle = document.getElementById("pageTitle");
    const productCardPreviewImg1 = document.getElementById("productCardPreviewImg1");
    const productCardPreviewImg2 = document.getElementById("productCardPreviewImg2");
    const productCardPreviewImg3 = document.getElementById("productCardPreviewImg3");
    const productCardPreviewImg4 = document.getElementById("productCardPreviewImg4");
    const productCardPreviewImg5 = document.getElementById("productCardPreviewImg5");
    const productBigPicture = document.getElementById("productBigPicture");
    const productTitle = document.getElementById("productTitle");
    const productPrice = document.getElementById("productPrice");
    const productColorCard1 = document.getElementById("productColorCard1");
    const productColorCard2 = document.getElementById("productColorCard2");
    const productColorCard3 = document.getElementById("productColorCard3");
    const productColorCard4 = document.getElementById("productColorCard4");
    // const selectSize = document.getElementById('selectSize');
    const productDetails = document.getElementById("productDetails");
    const aboutProduct = document.getElementById("aboutProduct");
    const showMoreToggleButton = document.getElementById("showMoreToggleButton");
    const addToCartPrice = document.getElementById("addToCartPrice");
    const addToCartButton = document.getElementById("addToCartButton");
    const cartItems = document.getElementById("cartItems");
    const colorName = document.getElementById("colorName");
    const colorInput = document.getElementById("colorInput");
    const productSelectedQuantity = document.getElementById("productSelectedQuantity");
    //productPrice
    //addToCartPrice
    //colorName
    //selectSize
    //productSelectedQuantity

    showMoreToggleButton.addEventListener('click', function toggleShowMore() {
        aboutBlur = document.getElementById("aboutBlur");
        if (aboutProduct.classList.contains('expanded')) {
            aboutProduct.classList.remove('expanded');
            showMoreToggleButton.textContent = 'Show More';
            aboutBlur.classList.remove('no-blur');
        } else {
            aboutProduct.classList.add('expanded');
            showMoreToggleButton.textContent = 'Show Less';
            aboutBlur.classList.add('no-blur');
        }
    } )
    

    if (product === 'Jakeson Windbreaker') {
        productPageTitle.innerHTML = "Jakeson Windbreaker";
        pageTitle.value = productPageTitle.innerHTML; 
        productCardPreviewImg1.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 1.jpg" alt="">`;
        productCardPreviewImg2.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 2.jpg" alt="">`;
        productCardPreviewImg3.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 3.jpg" alt="">`;
        productCardPreviewImg4.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 4.jpg" alt="">`;
        productCardPreviewImg5.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 5.jpg" alt="">`;
        productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 1.jpg" alt="">`;
        productTitle.innerHTML = `Weatherproof Midweight Soft Shell Jackets for Men - Men’s Water Resistant Windbreaker with Stand Collar (S-3XL)`;
        productPrice.innerHTML = `$52.50 - $69.99`;
        colorName.innerHTML = " Black";
        colorInput.value = "Black";
        productColorCard1.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 1.jpg" alt="">`;
        productColorCard2.innerHTML = `<img src="assets/Product-Images/Windbreaker-graphite 1.jpg" alt="">`;
        productColorCard3.innerHTML = `<img src="assets/Product-Images/Windbreaker-navy 1.jpg" alt="">`;
        productColorCard4.innerHTML = `<img src="assets/Product-Images/Windbreaker-camo 1.jpg" alt="">`;
        // selectSize.innerHTML = `<option value="Select">Select</option><option value="Small">Small</option><option value="Medium">Medium</option><option value="Large">Large</option><option value="Large Tall">Large Tall</option><option value="X-Large">X-Large</option><option value="X-Large Tall">X-Large Tall</option><option value="XX-Large">XX-Large</option><option value="XX-Large Tall">XX-Large Tall</option><option value="3X-Large">3X-Large</option><option value="3X-Large Tall">3X-Large Tall</option><option value="4X-Large Tall">4X-Large Tall</option>`;
        productDetails.innerHTML = `<strong>Fabric type: </strong><br />95% Polyester,<br />5% Other Fibers. <br /><br /><strong>Care instructions:</strong><br />Machine Wash <br /><br /><strong>Origin:</strong><br />Imported`;
        aboutProduct.innerHTML = `<ul><li><strong>Comfortable Quality Construction:</strong> Outer shell constructed using a soft durable lightweight polyester/spandex blend that is both water and wind resistant. Lining bonded with a soft brushed polyester for added comfort.</li><br /><li><strong>Active Design:</strong> Fabric blended using spandex fibers giving the jacket a slight stretch enabling it to move with your body, making activities like running, hiking, yardwork or anything you may find yourself doing outdoors a whole lot easier. Size down for a more fitted look.</li><br /><li><strong>Intuitive Utility:</strong> Fully zips up to the stand collar protecting your body and neck from the elements. Also includes adjustable velcro cuffs and drawcords at the waist for a more customizable fit and added protection. Features 3 exterior zip-secured pockets at the side and left chest, as well  as an interior chest pocket with a velcro closure.</li><br /><li><strong>Year Round Use:</strong> This jacket insulates in the cold weather using your own body heat, yet it's breathable fabric keeps you from overheating in higher temperatures. Perfect for a chilly summer night or a cold winter day.</li><br /><li><strong>Easy Care:</strong> Fully machine washable.</li><br /><li>Model is wearing a size Medium. He is 6' 1" and has a 40R chest.</li><br /></ul>`;
        addToCartPrice.innerHTML = `52.50 - $69.99`;

        

        selectSize.addEventListener('change', function() {
            const selectedOption = selectSize.options[selectSize.selectedIndex].value;
            if (selectedOption === 'Select'){
                productPrice.innerHTML = `$52.50 - $69.99`;
                addToCartPrice.innerHTML = `52.50 - $69.99`;
            }else if(selectedOption === 'Small'|| selectedOption === 'Large' || selectedOption === 'X-Large' ) {
                productPrice.innerHTML = `$52.50`;
                addToCartPrice.innerHTML = 52.50;
            }else if(selectedOption === 'Medium') {
                productPrice.innerHTML = `$53.96`;
                addToCartPrice.innerHTML = 53.96;
            }else if(selectedOption === 'Large Tall' || selectedOption === 'X-Large Tall' || selectedOption === 'XX-Large Tall' || selectedOption === '3X-Large Tall' || selectedOption === '4X-Large Tall') {
                productPrice.innerHTML = `$69.99`;
                addToCartPrice.innerHTML = 69.99;
            }
            else if(selectedOption === 'XX-Large' || selectedOption === '3X-Large') {
                productPrice.innerHTML = `$54.00`;
                addToCartPrice.innerHTML = 54.00;
            }
                

        })



        productCardPreviewImg1.addEventListener("mouseover", (event) => {
            productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 1.jpg" alt="">`;
        });
        productCardPreviewImg2.addEventListener("mouseover", (event) => {
            productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 2.jpg" alt="">`;
        });
        productCardPreviewImg3.addEventListener("mouseover", (event) => {
            productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 3.jpg" alt="">`;
        });
        productCardPreviewImg4.addEventListener("mouseover", (event) => {
            productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 4.jpg" alt="">`;
        });
        productCardPreviewImg5.addEventListener("mouseover", (event) => {
            productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 5.jpg" alt="">`;
        });
        productColorCard1.addEventListener("mouseover", () => {
            productCardPreviewImg1.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 1.jpg" alt="">`;
            productCardPreviewImg2.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 2.jpg" alt="">`;
            productCardPreviewImg3.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 3.jpg" alt="">`;
            productCardPreviewImg4.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 4.jpg" alt="">`;
            productCardPreviewImg5.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 5.jpg" alt="">`;
            productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 1.jpg" alt="">`;
            colorName.innerHTML = " Black";
            colorInput.value = "Black";
            
            

            productCardPreviewImg1.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 1.jpg" alt="">`;
            });
            productCardPreviewImg2.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 2.jpg" alt="">`;
            });
            productCardPreviewImg3.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 3.jpg" alt="">`;
            });
            productCardPreviewImg4.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 4.jpg" alt="">`;
            });
            productCardPreviewImg5.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 5.jpg" alt="">`;
            });


        })
        productColorCard2.addEventListener("mouseover", () => {
            productCardPreviewImg1.innerHTML = `<img src="assets/Product-Images/Windbreaker-graphite 1.jpg" alt="">`;
            productCardPreviewImg2.innerHTML = `<img src="assets/Product-Images/Windbreaker-graphite 2.jpg" alt="">`;
            productCardPreviewImg3.innerHTML = `<img src="assets/Product-Images/Windbreaker-graphite 3.jpg" alt="">`;
            productCardPreviewImg4.innerHTML = `<img src="assets/Product-Images/Windbreaker-graphite 4.jpg" alt="">`;
            productCardPreviewImg5.innerHTML = `<img src="assets/Product-Images/Windbreaker-graphite 5.jpg" alt="">`;
            productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-graphite 1.jpg" alt="">`;
            colorName.innerHTML = " Graphite";
            colorInput.value = "Graphite";
            



            productCardPreviewImg1.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-graphite 1.jpg" alt="">`;
            });
            productCardPreviewImg2.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-graphite 2.jpg" alt="">`;
            });
            productCardPreviewImg3.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-graphite 3.jpg" alt="">`;
            });
            productCardPreviewImg4.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-graphite 4.jpg" alt="">`;
            });
            productCardPreviewImg5.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-graphite 5.jpg" alt="">`;
            });
        })
        productColorCard3.addEventListener("mouseover", () => {
            productCardPreviewImg1.innerHTML = `<img src="assets/Product-Images/Windbreaker-navy 1.jpg" alt="">`;
            productCardPreviewImg2.innerHTML = `<img src="assets/Product-Images/Windbreaker-navy 2.jpg" alt="">`;
            productCardPreviewImg3.innerHTML = `<img src="assets/Product-Images/Windbreaker-navy 3.jpg" alt="">`;
            productCardPreviewImg4.innerHTML = `<img src="assets/Product-Images/Windbreaker-navy 4.jpg" alt="">`;
            productCardPreviewImg5.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 5.jpg" alt="">`;
            productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-navy 1.jpg" alt="">`;
            colorName.innerHTML = " Navy";
            colorInput.value = "Navy";



            productCardPreviewImg1.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-navy 1.jpg" alt="">`;
            });
            productCardPreviewImg2.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-navy 2.jpg" alt="">`;
            });
            productCardPreviewImg3.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-navy 3.jpg" alt="">`;
            });
            productCardPreviewImg4.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-navy 4.jpg" alt="">`;
            });
            productCardPreviewImg5.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-black 5.jpg" alt="">`;
            });
        })
        productColorCard4.addEventListener("mouseover", () => {
            productCardPreviewImg1.innerHTML = `<img src="assets/Product-Images/Windbreaker-camo 1.jpg" alt="">`;
            productCardPreviewImg2.innerHTML = `<img src="assets/Product-Images/Windbreaker-camo 2.jpg" alt="">`;
            productCardPreviewImg3.innerHTML = `<img src="assets/Product-Images/Windbreaker-camo 3.jpg" alt="">`;
            productCardPreviewImg4.innerHTML = `<img src="assets/Product-Images/Windbreaker-camo 4.jpg" alt="">`;
            productCardPreviewImg5.innerHTML = `<img src="assets/Product-Images/Windbreaker-camo 5.jpg" alt="">`;
            productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-camo 1.jpg" alt="">`;
            colorName.innerHTML = " Camo";
            colorInput.value = "Camo";



            productCardPreviewImg1.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-camo 1.jpg" alt="">`;
            });
            productCardPreviewImg2.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-camo 2.jpg" alt="">`;
            });
            productCardPreviewImg3.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-camo 3.jpg" alt="">`;
            });
            productCardPreviewImg4.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-camo 4.jpg" alt="">`;
            });
            productCardPreviewImg5.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/Windbreaker-camo 5.jpg" alt="">`;
            });
        })
    }
    else if (product === 'FL Hoodie') {
        productPageTitle.innerHTML = "FL Hoodie";
        pageTitle.value = productPageTitle.innerHTML; 
        productCardPreviewImg1.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 1.jpg" alt="">`;
        productCardPreviewImg2.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 2.jpg" alt="">`;
        productCardPreviewImg3.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 3.jpg" alt="">`;
        productCardPreviewImg4.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 4.jpg" alt="">`;
        productCardPreviewImg5.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 5.jpg" alt="">`;
        productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 1.jpg" alt="">`;
        productTitle.innerHTML = `Fruit of the Loom Men's Eversoft Fleece Hoodies, Moisture Wicking & Breathable, Pullover Hooded Sweatshirt`;
        productPrice.innerHTML = `$13.00`;
        colorName.innerHTML = " Black";
        colorInput.value = "Black";
        productColorCard1.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 1.jpg" alt="">`;
        productColorCard2.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-blackHeather 1.jpg" alt="">`;
        productColorCard3.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-greyHeather 1.jpg" alt="">`;
        productColorCard4.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-navy 1.jpg" alt="">`;
        selectSize.innerHTML = `<option value="Small" selected>Small</option><option value="Medium">Medium</option><option value="Large">Large</option><option value="X-Large">X-Large</option><option value="XX-Large">XX-Large</option><option value="3X-Large">3X-Large</option>`;
        productDetails.innerHTML = `<strong>Fabric type: </strong><br />60% Cotton, 40% Polyester, <br /><br /><strong>Care instructions:</strong><br />Machine Wash <br /><br /><strong>Origin:</strong><br />Imported <br/><br/> <strong>Closure type:</strong><br/>Pull On<br/><br/><strong>Country of Origin:</stron><br/>El Salvador<br/><br/>`;
        aboutProduct.innerHTML = `<ul><li>Male Model is 6’0” wearing a Size Medium. Female Model is 5’9” wearing size Small</li><br><li>Eversoft fabric provides premium softness was after wash</li><br><li>Double-needle stitching on the neck and hems for durability</li><br><li>Ribbed cuffs and waistband that hold their shape</li><br><li>Shoulder-to-shoulder neck tape for comfort and durability</li><br></ul>`;
        addToCartPrice.innerHTML = `13.00`;

        
// only changes the price shown in the add to cart section->product page.
        // selectSize.addEventListener('change', function() {
        //     const selectedOption = selectSize.options[selectSize.selectedIndex].value;
        //     if (selectedOption === 'Select'){
        //         productPrice.innerHTML = `$52.50 - $69.99`;
        //         addToCartPrice.innerHTML = `52.50 - $69.99`;
        //     }else if(selectedOption === 'Small'|| selectedOption === 'Large' || selectedOption === 'X-Large' ) {
        //         productPrice.innerHTML = `$52.50`;
        //         addToCartPrice.innerHTML = 52.50;
        //     }else if(selectedOption === 'Medium') {
        //         productPrice.innerHTML = `$53.96`;
        //         addToCartPrice.innerHTML = 53.96;
        //     }else if(selectedOption === 'Large Tall' || selectedOption === 'X-Large Tall' || selectedOption === 'XX-Large Tall' || selectedOption === '3X-Large Tall' || selectedOption === '4X-Large Tall') {
        //         productPrice.innerHTML = `$69.99`;
        //         addToCartPrice.innerHTML = 69.99;
        //     }
        //     else if(selectedOption === 'XX-Large' || selectedOption === '3X-Large') {
        //         productPrice.innerHTML = `$54.00`;
        //         addToCartPrice.innerHTML = 54.00;
        //     }
                

        // })



        productCardPreviewImg1.addEventListener("mouseover", (event) => {
            productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 1.jpg" alt="">`;
        });
        productCardPreviewImg2.addEventListener("mouseover", (event) => {
            productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 2.jpg" alt="">`;
        });
        productCardPreviewImg3.addEventListener("mouseover", (event) => {
            productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 3.jpg" alt="">`;
        });
        productCardPreviewImg4.addEventListener("mouseover", (event) => {
            productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 4.jpg" alt="">`;
        });
        productCardPreviewImg5.addEventListener("mouseover", (event) => {
            productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 5.jpg" alt="">`;
        });
        productColorCard1.addEventListener("mouseover", () => {
            productCardPreviewImg1.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 1.jpg" alt="">`;
            productCardPreviewImg2.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 2.jpg" alt="">`;
            productCardPreviewImg3.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 3.jpg" alt="">`;
            productCardPreviewImg4.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 4.jpg" alt="">`;
            productCardPreviewImg5.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 5.jpg" alt="">`;
            productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 1.jpg" alt="">`;
            colorName.innerHTML = " Black";
            colorInput.value = "Black";
            
            

            productCardPreviewImg1.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 1.jpg" alt="">`;
            });
            productCardPreviewImg2.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 2.jpg" alt="">`;
            });
            productCardPreviewImg3.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 3.jpg" alt="">`;
            });
            productCardPreviewImg4.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 4.jpg" alt="">`;
            });
            productCardPreviewImg5.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-black 5.jpg" alt="">`;
            });


        })
        productColorCard2.addEventListener("mouseover", () => {
            productCardPreviewImg1.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-blackHeather 1.jpg" alt="">`;
            productCardPreviewImg2.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-blackHeather 2.jpg" alt="">`;
            productCardPreviewImg3.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-blackHeather 3.jpg" alt="">`;
            productCardPreviewImg4.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-blackHeather 4.jpg" alt="">`;
            productCardPreviewImg5.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-blackHeather 5.jpg" alt="">`;
            productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-blackHeather 1.jpg" alt="">`;
            colorName.innerHTML = " Black Heather";
            colorInput.value = "Black Heather";
            



            productCardPreviewImg1.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-blackHeather 1.jpg" alt="">`;
            });
            productCardPreviewImg2.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-blackHeather 2.jpg" alt="">`;
            });
            productCardPreviewImg3.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-blackHeather 3.jpg" alt="">`;
            });
            productCardPreviewImg4.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-blackHeather 4.jpg" alt="">`;
            });
            productCardPreviewImg5.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-blackHeather 5.jpg" alt="">`;
            });
        })
        productColorCard3.addEventListener("mouseover", () => {
            productCardPreviewImg1.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-greyHeather 1.jpg" alt="">`;
            productCardPreviewImg2.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-greyHeather 2.jpg" alt="">`;
            productCardPreviewImg3.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-greyHeather 3.jpg" alt="">`;
            productCardPreviewImg4.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-greyHeather 4.jpg" alt="">`;
            productCardPreviewImg5.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-greyHeather 5.jpg" alt="">`;
            productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-greyHeather 1.jpg" alt="">`;
            colorName.innerHTML = " Grey Heather";
            colorInput.value = "Grey Heather";



            productCardPreviewImg1.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-greyHeather 1.jpg" alt="">`;
            });
            productCardPreviewImg2.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-greyHeather 2.jpg" alt="">`;
            });
            productCardPreviewImg3.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-greyHeather 3.jpg" alt="">`;
            });
            productCardPreviewImg4.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-greyHeather 4.jpg" alt="">`;
            });
            productCardPreviewImg5.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-greyHeather 5.jpg" alt="">`;
            });
        })
        productColorCard4.addEventListener("mouseover", () => {
            productCardPreviewImg1.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-navy 1.jpg" alt="">`;
            productCardPreviewImg2.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-navy 2.jpg" alt="">`;
            productCardPreviewImg3.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-navy 3.jpg" alt="">`;
            productCardPreviewImg4.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-navy 4.jpg" alt="">`;
            productCardPreviewImg5.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-navy 5.jpg" alt="">`;
            productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-navy 1.jpg" alt="">`;
            colorName.innerHTML = " Navy";
            colorInput.value = "Navy";



            productCardPreviewImg1.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-navy 1.jpg" alt="">`;
            });
            productCardPreviewImg2.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-navy 2.jpg" alt="">`;
            });
            productCardPreviewImg3.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-navy 3.jpg" alt="">`;
            });
            productCardPreviewImg4.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-navy 4.jpg" alt="">`;
            });
            productCardPreviewImg5.addEventListener("mouseover", (event) => {
                productBigPicture.innerHTML = `<img src="assets/Product-Images/fruitOfLoomHoodie-navy 5.jpg" alt="">`;
            });
        })

    }
    
    

    // CART PAGE
    
    


    


    // else if (product === 'windbreaker-navy') {
    //     productPageTitle.innerHTML = "Bulma/";
    //     productImg.innerHTML = "navy";
    //     productDescription.innerHTML = "navy";
    //     otherProductsLike.innerHTML = "navy";
    // }else if (product === 'windbreaker-camo') {
    //     productPageTitle.innerHTML = "Bulma/";
    //     productImg.innerHTML = "camo";
    //     productDescription.innerHTML = "camo";
    //     otherProductsLike.innerHTML = "camo";
    // }

    
}