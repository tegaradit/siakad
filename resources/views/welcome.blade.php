<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>

<body>

  <div class="flex flex-col lg:flex-row md:h-screen justify-center items-center w-full">
    <div class="card flex flex-grow items-center justify-center ">
    <h1 class="font-bold text-3xl mb-10">SIAKAD</h1>
      <form class="max-w-sm mx-auto flex flex-col items-center justify-center md:mt-auto mt-14">
        
        <div class="mb-5">
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
          <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
        </div>
        <div class="mb-5">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
          <input type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
        </div>
        <div class="flex items-start mb-5">


        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
      </form>
    </div>
    <div class="divider "></div>
    <div class=" bg-black h-full flex flex-col flex-grow justify-between items-center">
      <h1 class="text-white text-center text-4xl font-bold mt-12">WELCOME TO SIAKAD</h1>
      <img class="mt-14" src="https://media.tenor.com/bPaJaHgfKC8AAAAi/rock-one-eyebrow-raised-rock-staring.gif" alt="">
      <marquee class="text-white font-bold  " behavior="" direction="right">welcome to siakad</marquee>
    </div>
  </div>


  @yield('content')
  @vite('resources/js/app.js')
</body>

</html>