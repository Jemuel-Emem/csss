<div class="mt-64">
    <div class="text-container text-center text-6xl uppercase text-emerald-950 font-bold" id="logos">
    </div>
   <div class="flex justify-center gap-2">
    {{-- <div class="text-center">
        <a href="{{ route('online') }}"> <button class="bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg p-2 w-64 mt-2">Online</button></a>
     </div> --}}

     <div class="text-center">
         <a href="{{ route('offline') }}"> <button class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg p-2 w-64 mt-2">Take Survey</button></a>
      </div>
   </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
  const textContainer = document.querySelector(".text-container");
  const text = "Welcome to  CLIENT SATISFACTION SURVEY  ";
  let index = 0;

  function typeText() {
    if (index < text.length) {
      textContainer.textContent += text.charAt(index);
      index++;
      setTimeout(typeText, 100);
    }
  }

  typeText();
});

    </script>
</div>
