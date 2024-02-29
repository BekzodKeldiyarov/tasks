<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 *
 *
 * @OA\Get(
 *      path="/api/tasks",
 *      tags={"Task"},
 *      summary="Retrieve a list of tasks",
 *      description="Get a paginated list of tasks along with pagination information.",
 *
 *     @OA\Parameter (
 *         name="status", required=false, in="query", description="Optional Query Param for Filter",
 *         @OA\Schema(type="string", enum={"DRAFT", "WAITING", "PROCESSING", "COMPLETED"}, example="")
 *     ),
 *
 *     @OA\Parameter (
 *        name="date", required=false, in="query", description="Optional Query Param for Filter",
 *        @OA\Schema(type="date", example="2024-02-29")
 *      ),
 *
 *
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(
 *              @OA\Property(property="current_page", type="integer", example=1),
 *              @OA\Property(property="data", type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="id", type="integer"),
 *                      @OA\Property(property="title", type="string"),
 *                      @OA\Property(property="body", type="string"),
 *                      @OA\Property(property="status", type="string", enum={"DRAFT", "WAITING", "PROCESSING", "COMPLETED"}),
 *                      @OA\Property(property="date", type="string", format="date"),
 *                      @OA\Property(property="created_at", type="string", format="date-time"),
 *                      @OA\Property(property="updated_at", type="string", format="date-time")
 *                  )
 *              ),
 *              @OA\Property(property="first_page_url", type="string"),
 *              @OA\Property(property="from", type="integer"),
 *              @OA\Property(property="last_page", type="integer"),
 *              @OA\Property(property="last_page_url", type="string"),
 *              @OA\Property(property="links", type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="url", type="string", nullable=true),
 *                      @OA\Property(property="label", type="string"),
 *                      @OA\Property(property="active", type="boolean")
 *                  )
 *              ),
 *              @OA\Property(property="next_page_url", type="string", nullable=true),
 *              @OA\Property(property="path", type="string"),
 *              @OA\Property(property="per_page", type="integer"),
 *              @OA\Property(property="prev_page_url", type="string", nullable=true),
 *              @OA\Property(property="to", type="integer"),
 *              @OA\Property(property="total", type="integer")
 *          )
 *      )
 *  )
 *
 *
 *
 *
 *
 * @OA\Post(
 *     path="/api/tasks",
 *     summary="Creating a Task",
 *     tags = {"Task"},
 *     @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="title", type="string", example="Some title"),
 *                      @OA\Property(property="body", type="text", example="Some long text for body because minimum characters length should be 32."),
 *                       @OA\Property(property="status", type="string", enum={"DRAFT", "WAITING", "PROCESSING", "COMPLETED"}),
 *                      @OA\Property(property="date", type="date", example="2024-02-29"),
 *                  )
 *              }
 *          )
 *     ),
 *
 *
 *     @OA\Response(
 *         response=201,
 *         description="CREATED",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example="true"),
 *             @OA\Property(property="message", type="string", example="null"),
 *             @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  @OA\Property(property="title", type="string", example="Some Title"),
 *                  @OA\Property(property="body", type="text", example="Some Body Description Here"),
 *                  @OA\Property(property="status", type="string", example="DRAFT"),
 *                  @OA\Property(property="date", type="date", example="2020-02-03"),
 *                  @OA\Property(property="updated_at", type="timestamp", example="2024-02-28T23:34:07.000000Z"),
 *                  @OA\Property(property="created_at", type="timestamp", example="2024-02-28T23:34:07.000000Z"),
 *                  @OA\Property(property="id", type="int", example="1"),
 *                  ),
 *         )
 *     ),
 *
 *      @OA\Response(
 *           response=422,
 *          description="Error: Unprocessable Content",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="boolean", example="false"),
 *              @OA\Property(property="message", type="string", example="Validation errors"),
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  @OA\Property(
 *                      property="body",
 *                      type="array",
 *                      @OA\Items(type="string", example="The title must be at least 32 characters long.")
 *                  )
 *              )
 *          )
 *      )
 * )
 *
 *
 *
 * @OA\Get(
 *      path="/api/tasks/{id}",
 *      tags={"Task"},
 *      summary="Retrieve a single task by ID",
 *      description="Get details of a single task by its ID.",
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the task to retrieve",
 *          @OA\Schema(type="integer")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example=null, nullable=true),
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer"),
 *                  @OA\Property(property="title", type="string"),
 *                  @OA\Property(property="body", type="string"),
 *                  @OA\Property(property="status", type="string", enum={"DRAFT", "WAITING", "PROCESSING", "COMPLETED"}),
 *                  @OA\Property(property="date", type="string", format="date"),
 *                  @OA\Property(property="created_at", type="string", format="date-time"),
 *                  @OA\Property(property="updated_at", type="string", format="date-time")
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Task not found",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="NOT FOUND"),
 *              @OA\Property(property="data", type="string", example=null)
 *          )
 *      )
 *  )
 *
 *
 *
 *
 * @OA\Put(
 *      path="/api/tasks/{id}",
 *      tags={"Task"},
 *      summary="Update a task by ID",
 *      description="Update details of a task by its ID.",
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the task to update",
 *          @OA\Schema(type="integer")
 *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              @OA\Property(property="title", type="string", example="Some new title for updating current one"),
 *              @OA\Property(property="body", type="string",  example="Some new description for task in order to update current data"),
 *              @OA\Property(property="status", type="string", enum={"DRAFT", "WAITING", "PROCESSING", "COMPLETED"}),
 *              @OA\Property(property="date", type="string", format="date")
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="boolean", example=true),
 *              @OA\Property(property="message", type="string", example=null),
 *              @OA\Property(property="data", type="object",
 *                   @OA\Property(property="id", type="int", example="1"),
 *                   @OA\Property(property="title", type="string", example="Some Title"),
 *                   @OA\Property(property="body", type="text", example="Some Body Description Here"),
 *                   @OA\Property(property="status", type="string", example="DRAFT"),
 *                   @OA\Property(property="date", type="date", example="2020-02-03"),
 *                   @OA\Property(property="updated_at", type="timestamp", example="2024-02-28T23:34:07.000000Z"),
 *                   @OA\Property(property="created_at", type="timestamp", example="2024-02-28T23:34:07.000000Z"),
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Task not found",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="NOT FOUND"),
 *              @OA\Property(property="data", type="string", example=null)
 *          )
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Validation errors",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="boolean", example=false),
 *              @OA\Property(property="message", type="string", example="Validation errors"),
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="title", type="array",
 *                      @OA\Items(type="string", example="The title must be at least 8 characters long.")
 *                  )
 *              )
 *          )
 *      )
 *  )
 *
 *
 *
 *
 * @OA\Delete(
 *      path="/api/tasks/{id}",
 *      tags={"Task"},
 *      summary="Delete a task by ID",
 *      description="Delete a task by its ID.",
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the task to delete",
 *          @OA\Schema(type="integer")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Task deleted successfully",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="DELETED"),
 *              @OA\Property(property="data", type="object", example=null)
 *          )
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Task not found",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="NOT FOUND"),
 *              @OA\Property(property="data", type="object", example=null)
 *          )
 *      )
 *  )
 *
 *
 *
 *
 */
class TaskController extends Controller
{

}
