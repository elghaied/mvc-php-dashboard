<div id="popup" class="max-w-[550px] border-2 hidden  bg-white border-black w-full h-full max-h-[550px] p-5  fixed rounded-[5px] top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2  ">

    <form id="update-car-form"  method="POST" action="/update" class="w-full h-full">
    <input type="hidden" name="carId" id="carId" value="">

        <div class="flex flex-col gap-3 p-5  h-full">

            <div class="flex flex-row items-center">
                <div class="font-bold text-2xl">Add Car</div>
            </div>

            <div class="flex flex-col gap-3">
                <div class="flex flex-row items-center">
                    <div class="font-bold">Brand</div>
                    <input type="text" name="brand" id="brand" class="border border-gray-400 rounded-[5px] p-1 ml-3">
                </div>

                <div class="flex flex-row items-center">
                    <div class="font-bold">Model</div>
                    <input type="text" name="model" id="model" class="border border-gray-400 rounded-[5px] p-1 ml-3">
                </div>

                <div class="flex flex-row items-center">
                    <div class="font-bold">License Plate</div>
                    <input type="text" name="license_plate" id="license_plate" class="border border-gray-400 rounded-[5px] p-1 ml-3">
                </div>

                <div class="flex flex-row items-center">
                    <div class="font-bold">Price</div>
                    <input type="text" name="price" id="price" class="border border-gray-400 rounded-[5px] p-1 ml-3">
                </div>

                <div class="flex flex-row items-center">
                    <div class="font-bold">Sale Type</div>
                   <!-- select -->
                    <select name="sale_type" id="sale_type" class="border border-gray-400 rounded-[5px] p-1 ml-3">
                    <?php 
                          
                            foreach ($this->carFormOptions['sale_type'] as $saleType) {
                                echo '<option value="' . $saleType . '">' . $saleType . '</option>';
                            }
                          
                    
                    ?>
                    </select>
                </div>

                <div class="flex flex-row items-center">
                    <div class="font-bold">Is Reserved</div>
                    <input type="checkbox" name="reserved" id="reserved" class="border border-gray-400 rounded-[5px] p-1 ml-3">
                </div>

                <div class="flex flex-row items-center">
                    <div class="font-bold">Fuel</div>
    
                    <select name="fuel" id="fuel" class="border border-gray-400 rounded-[5px] p-1 ml-3">
                    <?php 
                          
                          foreach ($this->carFormOptions['fuel'] as $fuel) {
                              echo '<option value="' . $fuel . '">' . $fuel . '</option>';
                          }
                        ?>
                    </select>
                    
                </div>
                <div class=" flex items-center justify-end gap-2">

                <button type="submit" class="bg-red-700 text-white font-bold py-2 px-4 rounded-[5px]">Update Car</button>
                <span id="popup-close" type="button" class="bg-black cursor-pointer text-white font-bold py-2 px-4 rounded-[5px]">Cancel</span>

                </div>
    
            </div>

    </form>


</div>