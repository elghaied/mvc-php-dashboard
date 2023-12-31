<div class=" w-full h-[81px] bg-red-700 text-white flex items-center justify-start px-7">

<div class="logo font-mono text-2xl uppercase ">5Team</div> 

</div>
<div class="main flex ">


<div class=" w-full max-w-56 bg-black h-[calc(100vh-81px)] text-white flex flex-col p-5 gap-3">

<?php

foreach ($navItems as $item) {
    echo '<a href="' . $item['url'] . '" class="nav-item hover:bg-white hover:bg-opacity-40 hover:text-black">' . $item['label'] . '</a>';
}
?>
</div>