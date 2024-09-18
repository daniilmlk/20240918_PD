<x-app-layout>
    <div class="w-full rounded overflow-hidden shadow-lg p-4 bg-white mb-4">
            <div class="flex justify-between">
                <div>       
                    <a class="font-bold text-xl mb-2" href="{{ route('song.show', $song->id) }}">
                        {{ $song->title }}
                    </a>
                    <div class="px-6 pt-4 pb-2">
                        <span class="inline-block shadow-lg bg-gray-400 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $song->artist }}</span>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        <span class="inline-block shadow-lg bg-gray-400 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $song->genre }}</span>
                    </div>
                </div>
                <div>
                    <a href="{{ route('song.edit', $song->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Edit
                    </a>
                    <form action="{{ route('song.destroy', $song->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            <div class="px-6 pt-4 pb-2">
                <h1>playlists</h1>
                <table class="w-full table-auto">
                    <tbody>
                        @foreach($song->playlists as $playlist)
                            <tr>
                                <td class="border px-4 py-2">
                                    {{ $playlist->name }} | {{ $playlist->tag }}

                                    <form action="{{ route('song.removeplaylist', $song->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <input type="hidden" name="playlist" value="{{ $playlist->id }}">
                                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                            Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <form action="{{ route('song.addplaylist', $song->id) }}" method="POST" class="inline-block">
                    @csrf
                    <label for="playlist">Choose a playlist:</label>
                    <select name="playlist" id="playlist">
                        @foreach($allPlaylists as $playlist)
                            <option value="{{ $playlist->id }}">{{ $playlist->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Add
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
