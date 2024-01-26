<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Repositories\Movie\MovieRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MovieController extends Controller
{
    private MovieRepositoryInterface $movieRepository;

    public function __construct(MovieRepositoryInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json([
           'response' => $this->movieRepository->getAllMovies()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request): JsonResponse
    {
        return response()->json([
           'result' => $this->movieRepository->createMovie($request->all())
        ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($movieId)
    {
       return response()->json([
          'result' => $this->movieRepository->getMovieById($movieId)
       ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, $movieId)
    {
        return response()->json([
           'result' => $this->movieRepository->updateMovie($movieId, $request->all()),
           'message' => 'Movie updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($movieId): JsonResponse
    {
        try {
            $this->movieRepository->deleteMovie($movieId);

            return response()->json(['message' => 'Movie deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete movie.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
