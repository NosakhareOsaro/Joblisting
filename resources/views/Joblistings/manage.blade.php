<x-layout>
    <x-card class="p-10">
      <header>
        <h1 class="my-6 text-3xl font-bold text-center uppercase">
          Manage Jobs
        </h1>
      </header>
  
      <table class="w-full rounded-sm table-auto">
        <tbody>
          @unless($joblistings->isEmpty())
          @foreach($joblistings as $joblisting)
          <tr class="border-gray-300">
            <td class="px-4 py-8 text-lg border-t border-b border-gray-300">
              <a href="/joblistings/{{$joblisting->id}}"> {{$joblisting->title}} </a>
            </td>
            <td class="px-4 py-8 text-lg border-t border-b border-gray-300">
              <a href="/joblistings/{{$joblisting->id}}/edit" class="px-6 py-2 text-blue-400 rounded-xl"><i
                  class="fa-solid fa-pen-to-square"></i>
                Edit</a>
            </td>
            <td class="px-4 py-8 text-lg border-t border-b border-gray-300">
              <form method="POST" action="/joblistings/{{$joblisting->id}}">
                @csrf
                @method('DELETE')
                <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
          @else
          <tr class="border-gray-300">
            <td class="px-4 py-8 text-lg border-t border-b border-gray-300">
              <p class="text-center">No Job listings Found</p>
            </td>
          </tr>
          @endunless
  
        </tbody>
      </table>
    </x-card>
  </x-layout>